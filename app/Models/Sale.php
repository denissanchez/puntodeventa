<?php

namespace App\Models;

use App\Scopes\CurrentBranchScope;
use App\User;
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
class Sale extends Model
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

    public function addDetails($details)
    {
        foreach ($details as $key=>$detail) {
            $this->addDetail([
                'product_id' => $detail['id'],
                'item' => $key + 1,
                'purchase_code' => '-', // TODO: Implementar la busqueda de documentos de compra
                'quantity' => $detail['quantity'],
                'unit_price' => $detail['unit_price'],
                'discount' => $detail['discount']
            ]);
        }
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

    public function details() {
        return $this->hasMany(SaleDetail::class);
    }
}
