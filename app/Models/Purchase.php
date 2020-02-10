<?php

namespace App\Models;

use App\Scopes\AvailableStateScope;
use App\Scopes\CurrentBranchScope;
use App\User;
use App\Utils\StateInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Purchase
 * @package App\Models
 * @property int branch_id
 * @property int seller_id
 * @property array provider
 * @property string seller_name
 * @property string code
 * @property string type
 * @property string currency
 * @property string commentary
 * @property string state
 */
class Purchase extends Model
{
    protected $fillable = [
        'branch_id', 'seller_id', 'provider', 'seller_name',
        'code', 'date', 'type', 'currency', 'commentary', 'state'
    ];

    protected static function boot()
    {
        parent::boot();
        self::addGlobalScope(new CurrentBranchScope());
        self::addGlobalScope(new AvailableStateScope());
    }

    public function setProviderAttribute($value)
    {
        $this->attributes['provider'] = serialize($value);
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

    public function setSellerNameAttribute($value)
    {
        $this->attributes['seller_name'] = strtoupper($value);
    }

    public function setCommentaryAttribute($value)
    {
        $this->attributes['commentary'] = strtoupper($value);
    }

    public function setStateAttribute($value)
    {
        $this->attributes['state'] = strtoupper($value);
    }

    public function getProviderAttribute()
    {
        return unserialize($this->attributes['provider']);
    }

    public function getDateAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['date']));
    }

    private function quantitiesSoldAndPurchasedIsEquals()
    {
        foreach($this->details as $detail)
        {
            if ($detail->init_quantity !== $detail->current_quantity)
            {
                return false;
            }
        }
        return true;
    }

    private function isSameSellerOrIsAdmin()
    {
        return $this->attributes['seller_id'] === Auth::user()->id;
    }

    private function isInRangeDateToAction($days)
    {
        $registered_at = date('Y-m-d', strtotime($this->attributes['date']));
        $now = date('Y-m-d', strtotime(Carbon::now()));
        $interval = date_diff(new \DateTime($now), new \DateTime($registered_at));
        return $interval->format('%a') < $days;
    }

    private function isValidState() {
        return $this->attributes['state'] === StateInfo::CONFIRMED_STATE;
    }

    public function getIsEditableAttribute()
    {
        return $this->isSameSellerOrIsAdmin() && $this->isValidState() && $this->isInRangeDateToAction(3) && $this->quantitiesSoldAndPurchasedIsEquals();
    }

    public function getIsDeleteableAttribute()
    {
        return $this->isSameSellerOrIsAdmin() && $this->isValidState() && $this->isInRangeDateToAction(5) && $this->quantitiesSoldAndPurchasedIsEquals();
    }

    public static function addRecord($values)
    {
        return self::create(array_merge($values,
            [
                'branch_id' => Auth::user()->branch_id,
                'seller_id' => Auth::user()->id
            ]
        ));
    }

    /* El array del detalle sería los productos que se agregan en la tabla inferior
     * por lo tanto el $detail[id] sería el ID del producto que ya se encuentra
     * registrado en la base de datos
     * */
    public function addDetails($details) {
        foreach ($details as $key=>$detail) {
            $this->addDetail([
                'product_id' => $detail['id'],
                'item' => $key + 1,
                'purchase_code' => $this->attributes['code'],
                'init_quantity' => $detail['quantity'],
                'current_quantity' => $detail['quantity'],
                'unit_price' => $detail['unit_price']
            ]);
        }
    }

    public function cancel($commentary)
    {
        $this->update([
            'commentary' => $commentary,
            'state' => StateInfo::CANCELED_STATE
        ]);

        foreach ($purchase->details as $detail) {
            $detail->removeUnits();
        }

        $purchase->details()->update([
            'state' => StateInfo::CANCELED_STATE
        ]);
    }

    public function addDetail($detail)
    {
        $this->details()->create($detail);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(OwnerDocument::class);
    }

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
