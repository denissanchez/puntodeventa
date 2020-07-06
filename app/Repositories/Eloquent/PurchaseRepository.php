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

    public function create(array $attributes): Model
    {
        $purchase = parent::create($attributes);
        foreach ($attributes['products'] as $key => $product) {
            $product = array_merge($product, [
                'item' => $key + 1,
                'price_defined' => $product['price']
            ]);
            $purchase->details()->create($product);
        }
        return $purchase;
    }
}
