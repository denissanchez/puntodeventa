<?php


namespace App\Repositories\Eloquent;


use App\Models\Movement;
use App\Models\MovementDetail;
use App\Models\Product;
use App\Models\ProductStore;
use App\Models\Store;
use App\Repositories\SaleRepositoryInterface;
use App\Utils\MovementType;
use App\Utils\UtilsKey;
use Illuminate\Database\Eloquent\Model;

class SaleRepository extends MovementRepository implements SaleRepositoryInterface
{
    const PRODUCT_ID_KEY = "product_id";
    const QUANTITY_KEY = "quantity";

    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->type = MovementType::SALE_MOVEMENT;
    }

    public function create(array $attributes): Model
    {
        $sale = parent::create($attributes);

        $store_id = session(UtilsKey::CURRENT_STORE_ID);

        foreach ($attributes['products'] as $key => $detail) {
            $detail = array_merge($detail, ['item' => $key + 1]);
            $detail = $sale->details()->create($detail);
            $product_id = $detail[SaleRepository::PRODUCT_ID_KEY];
            $purchase_details = Product::find($product_id)
                ->purchases()->where('store_id', $store_id)->get()->filter(function ($purchase) use ($product_id) {
                    return $purchase->details()->where([
                        [SaleRepository::PRODUCT_ID_KEY, $product_id],
                        ['current_quantity', '>', 0]
                    ])->get();
                });
            $required_quantity = $detail[SaleRepository::QUANTITY_KEY];
            $index = 0;

            $product_store = ProductStore::where([
                ['store_id', $sale->store_id],
                [SaleRepository::PRODUCT_ID_KEY, $detail[SaleRepository::PRODUCT_ID_KEY]]
            ])->first();

            $product_store->sold_units += $detail->quantity;
            $product_store->save();

            do {
                $purchase_detail = MovementDetail::find($purchase_details[$index]->id);
                if ($purchase_detail->current_quantity > $required_quantity) {
                    $quantity = $required_quantity;
                    $required_quantity = 0;
                    $purchase_detail->current_quantity -= $required_quantity;
                } else {
                    $quantity = $purchase_detail->current_quantity;
                    $required_quantity -= $purchase_details[$index]->current_quantity;
                    $purchase_detail->current_quantity = 0;
                }
                $purchase_detail->save();
                $detail->purchaseDocuments()->attach($purchase_detail->id, [
                    SaleRepository::QUANTITY_KEY => $quantity
                ]);
                $index++;
            } while($required_quantity > 0);
        }

        $sale->refresh();

        return $sale;
    }
}
