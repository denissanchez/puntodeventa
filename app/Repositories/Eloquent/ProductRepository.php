<?php


namespace App\Repositories\Eloquent;


use App\Repositories\ProductRepositoryInterface;
use App\Utils\UtilsKey;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

        $this->saveUtil(UtilsKey::CATEGORY, $product->category);
        $this->saveUtil(UtilsKey::LABORATORY, $product->laboratory);
        $this->saveUtil(UtilsKey::BRAND, $product->brand);
        $this->saveUtil(UtilsKey::MEASURE_UNIT, $product->measure_unit);

        return $product;
    }

    public function saveUtil($key, $value)
    {
        if ($value != null || $value != "") {
            $util = DB::table('utils')->where([['key', $key], ['value', $value]])->first();
            if ($util == null) {
                DB::table('utils')->insert([
                    'key' => $key,
                    'value' => $value
                ]);
            }
        }
    }

    public function search($value): Collection
    {
        return $this->model->where(function ($query) use ($value) {
            $query->where('name', 'LIKE', '%' . $value . '%');
            $query->orWhere('origin_code', 'LIKE', '%' . $value . '%');
            $query->orWhere('internal_code', 'LIKE', '%' . $value . '%');
        })->get();
    }
}
