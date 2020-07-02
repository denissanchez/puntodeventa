<?php


namespace App\Repositories\Eloquent;


use App\Repositories\PurchaseRepositoryInterface;
use App\Utils\MovementType;
use Illuminate\Database\Eloquent\Model;

class PurchaseRepository extends MovementRepository implements PurchaseRepositoryInterface
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->type = MovementType::PURCHASE_MOVEMENT;
    }
}
