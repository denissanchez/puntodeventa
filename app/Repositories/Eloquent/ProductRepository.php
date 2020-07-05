<?php


namespace App\Repositories\Eloquent;


use App\Repositories\ProductRepositoryInterface;
use App\Utils\UtilsKey;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function create(array $attributes): Model
    {
        $store_id = session(UtilsKey::CURRENT_STORE_ID);

        $product = parent::create($attributes);

        if (!$product->internal_code) {
            $product->internal_code = $product->id . substr($product->name, 0, 3);
        }

        $internal_code = strtoupper($product->internal_code);
        $product->internal_code = str_pad($internal_code, 6, "0", STR_PAD_LEFT);
        $product->save();

        $product->stores()->attach($store_id, $attributes);

        return $product;
    }

    public function search($value): Collection
    {
        return $this->model->where('origin_code', 'LIKE', '%' . $value . '%')->orWhere([
            ['internal_code', 'LIKE', '%' . $value . '%'],
            ['name', 'LIKE', '%' . $value . '%'],
        ]);
    }
}
