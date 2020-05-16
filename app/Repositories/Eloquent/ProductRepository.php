<?php


namespace App\Repositories\Eloquent;


use App\Models\Product;
use App\Pipelines\Filters\SearchFilter;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * ProductRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();

//        $pipelines = [
//            SearchFilter::class,
//        ];
//
//        $builder = $this->model->newQuery();
//
//        return app(Pipeline::class)
//            ->send($builder)
//            ->through($pipelines)
//            ->then(function($builder) {
//                return $builder->get();
//            });
    }
}
