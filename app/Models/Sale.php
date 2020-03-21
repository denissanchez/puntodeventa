<?php

namespace App\Models;

use App\Scopes\CurrentBranchScope;
use App\User;
use App\Utils\Interfaces\Document;
use App\Utils\StateInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Sale
 * @package App\Models
 * @property int branch_id
 * @property int seller_id
 * @property string code
 * @property string client
 * @property string state
 * @property string type
 * @property string currency
 * @property string commentary
 */
class Sale extends Model implements Document
{
    protected $fillable = [
        'branch_id', 'seller_id', 'code', 'client',
        'state', 'type', 'currency', 'commentary'
    ];

    protected static function boot()
    {
        parent::boot();
        self::addGlobalScope(new CurrentBranchScope());
    }

    public function getOwnerDocument()
    {
        return $this->attributes['client'];
    }

    public function getCreatedAtAttribute()
    {
        return date('Y-m-d', strtotime($this->attributes['created_at']));
    }

    public function setClientAttribute($value)
    {
        $this->attributes['client'] = serialize($value);
    }

    public function getClientAttribute()
    {
        return unserialize($this->attributes['client']);
    }

    public function getOwnerDocumentAttribute()
    {
        return unserialize($this->attributes['owner_document']);
    }

    public function getAmmountAttribute()
    {
        $accumulated = 0;
        foreach ($this->details as $detail)
        {
            $accumulated += $detail->unit_price_defined;
        }
        return $accumulated;
    }

    private function isSameSellerOrIsAdmin()
    {
        return $this->attributes['seller_id'] === Auth::user()->id;
    }

    private function isInRangeDateToAction($days)
    {
        $registered_at = date('Y-m-d', strtotime($this->attributes['created_at']));
        $now = date('Y-m-d', strtotime(Carbon::now()));
        $interval = date_diff(new \DateTime($now), new \DateTime($registered_at));
        return $interval->format('%a') < $days;
    }

    public function getIsDeleteableAttribute()
    {
        return $this->isSameSellerOrIsAdmin() && $this->isInRangeDateToAction(1);
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

    public function addDetails($details)
    {

        foreach ($details as $key=>$detail) {
            $product = Product::find($detail['id']);
            $this->addDetail([
                'product_id' => $detail['id'],
                'item' => $key + 1,
                'quantity' => $detail['quantity'],
                'unit_price' => $product->unit_price,
                'unit_price_defined' => $detail['unit_price_defined']
            ]);
        }
    }

    public function generateBillingCode($type)
    {
        $latest = BillingCode::where('type', $type)->latest()->first();
        if (!$latest) {
            return new BillingCode([
                'branch_id' => Auth::user()->branch_id,
                'prefix' => '-',
                'type' => '-',
                'incrementable' => 0,
            ]);
        }
        return BillingCode::create([
            'branch_id' => Auth::user()->branch_id,
            'prefix' => $latest->prefix,
            'type' => $type,
            'incrementable' => $latest->incrementable + 1
        ]);
    }

    public function addDetail($detail)
    {
        $this->details()->create($detail);
    }

    public function cancel($commentary)
    {
        $this->update([
            'commentary' => $commentary,
            'state' => StateInfo::CANCELED_STATE
        ]);
        $this->details()->update(['state' => StateInfo::CANCELED_STATE]);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function details() {
        return $this->hasMany(SaleDetail::class);
    }
}
