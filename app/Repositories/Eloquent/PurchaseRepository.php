<?php


namespace App\Repositories\Eloquent;


use App\Models\ProductStore;
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
        foreach ($attributes['products'] as $key => $detail) {
            $detail = array_merge($detail, [
                'item' => $key + 1,
                'current_quantity' => $detail['quantity'],
            ]);
            $detail = $purchase->details()->create($detail);

            $product_store = ProductStore::where([
                ['store_id', $purchase->store_id],
                ['product_id', $detail['product_id']]
            ])->first();

            $product_store->purchased_units += $detail->current_quantity;
            $product_store->save();
        }
        return $purchase;
    }
}
