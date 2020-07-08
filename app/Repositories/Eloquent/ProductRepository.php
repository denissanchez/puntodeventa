<?php


namespace App\Repositories\Eloquent;


use App\Models\Product;
use App\Repositories\BrandRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\LaboratoryRepositoryInterface;
use App\Repositories\MeasureUnitRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Utils\UtilsKey;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public CategoryRepositoryInterface $categoryRepository;
    public LaboratoryRepositoryInterface $laboratoryRepository;
    public BrandRepositoryInterface $brandRepository;
    public MeasureUnitRepositoryInterface $measureUnitRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        LaboratoryRepositoryInterface $laboratoryRepository,
        BrandRepositoryInterface $brandRepository,
        MeasureUnitRepositoryInterface $measureUnitRepository
    )
    {
        parent::__construct(new Product);

        $this->categoryRepository = $categoryRepository;
        $this->laboratoryRepository = $laboratoryRepository;
        $this->brandRepository = $brandRepository;
        $this->measureUnitRepository = $measureUnitRepository;
    }

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

    public function utils(): array
    {
        $categories = $this->categoryRepository->get();
        $laboratories = $this->laboratoryRepository->get();
        $brands = $this->brandRepository->get();
        $measureUnits = $this->measureUnitRepository->get();
        return [
            'categories' => $categories,
            'laboratories' => $laboratories,
            'brands' => $brands,
            'measureUnits' => $measureUnits,
        ];
    }

}
