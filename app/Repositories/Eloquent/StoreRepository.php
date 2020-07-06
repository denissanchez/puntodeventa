<?php


namespace App\Repositories\Eloquent;

use App\Repositories\StoreRepositoryInterface;
use App\Utils\UtilsKey;

class StoreRepository extends BaseRepository implements StoreRepositoryInterface
{
    public function productsWithStock($search = ""): array
    {
        $store_id = session(UtilsKey::CURRENT_STORE_ID);
        $store = $this->model->find($store_id);

        $products = $store->products()->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
            $query->orWhere('origin_code', 'LIKE', '%' . $search . '%');
            $query->orWhere('internal_code', 'LIKE', '%' . $search . '%');
        })->get()->filter(function ($product) {
            return $product->pivot->current_quantity > 0;
        });

        $arr_products = [];

        foreach ($products as $product) {
            array_push($arr_products, [
                'id' => $product->id,
                'internal_code' => $product->internal_code,
                'measure_unit' => $product->measure_unit,
                'name' => $product->name,
                'price' => $product->pivot->unit_price,
                'stock' => $product->pivot->current_quantity
            ]);
        }

        return $arr_products;
    }
}
