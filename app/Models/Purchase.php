<?php

namespace App\Models;

use App\Scopes\CurrentBranchScope;
use App\User;
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
        'code', 'type', 'currency', 'commentary', 'state'
    ];

    protected static function boot()
    {
        parent::boot();
        self::addGlobalScope(new CurrentBranchScope());
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
                'product_id' => $details['id'],
                'item' => $key + 1,
                'purchase_code' => $this->attributes['code'],
                'init_quantity' => $details['quantity'],
                'current_quantity' => $details['quantity'],
                'unit_price' => $details['unit_price']
            ]);
        }
    }

    public function addDetail($detail)
    {
        $this->details()->create($detail);
    }

    public static function purchaseDetailsOfProductWithAvailableStockByProductId($product_id)
    {
        return self::all()
            ->details()
            ->ofProduct($product_id)->withAvailableStock()
            ->orderBy('id', 'asc')->get();
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
