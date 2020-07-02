<?php


namespace App\Repositories\Eloquent;


use App\Repositories\SaleRepositoryInterface;
use App\Utils\MovementType;
use Illuminate\Database\Eloquent\Model;

class SaleRepository extends MovementRepository implements SaleRepositoryInterface
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->type = MovementType::SALE_MOVEMENT;
    }
}
