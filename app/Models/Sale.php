<?php

namespace App\Models;

use App\Scopes\CurrentBranchScope;
use App\User;
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
class Sale extends Model
{
    protected $fillable = [
        'branch_id', 'seller_id', 'code', 'client',
        'state', 'type', 'currency', 'commentary'
    ];

    public function details() {
        return $this->hasMany(SaleDetail::class);
    }
}
