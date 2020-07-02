<?php


namespace App\Repositories\Eloquent;


use App\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    /**
     * ProductRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes): Model
    {
        $product = parent::create($attributes);

        if (!$product->internal_code) {
            $product->internal_code = $product->id . substr($product->name, 0, 3);
        }

        $internal_code = strtoupper($product->internal_code);
        $product->internal_code = str_pad($internal_code, 6, "0",STR_PAD_LEFT);
        $product->save();
        return $product;
    }
}
