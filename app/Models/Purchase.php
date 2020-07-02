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
}
