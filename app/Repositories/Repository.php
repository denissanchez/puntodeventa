<?php


namespace App\Repositories;


use Illuminate\Support\Facades\DB;

class Repository implements RepositoryInterface
{
    private ProductRepositoryInterface $productRepository;
    private PurchaseRepositoryInterface $purchaseProductRepository;
    private SaleRepositoryInterface $saleRepository;
    private StoreRepositoryInterface $storeRepository;
    private UserRepositoryInterface $userRepository;
    private BrandRepositoryInterface $brandRepository;
    private CategoryRepositoryInterface $categoryRepository;
    private LaboratoryRepositoryInterface $laboratoryRepository;
    private MeasureUnitRepositoryInterface $measureUnitRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        PurchaseRepositoryInterface $purchaseRepository,
        SaleRepositoryInterface $saleRepository,
        StoreRepositoryInterface $storeRepository,
        UserRepositoryInterface $userRepository,
        BrandRepositoryInterface $brandRepository,
        CategoryRepositoryInterface $categoryRepository,
        LaboratoryRepositoryInterface $laboratoryRepository,
        MeasureUnitRepositoryInterface $measureUnitRepository
    ) {
        $this->productRepository = $productRepository;
        $this->purchaseProductRepository = $purchaseRepository;
        $this->saleRepository = $saleRepository;
        $this->storeRepository = $storeRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->laboratoryRepository = $laboratoryRepository;
        $this->measureUnitRepository = $measureUnitRepository;
    }

    public function products(): ProductRepositoryInterface
    {
        return $this->productRepository;
    }

    public function users(): UserRepositoryInterface
    {
        return $this->userRepository;
    }

    public function stores(): StoreRepositoryInterface
    {
        return $this->storeRepository;
    }

    public function purchases(): PurchaseRepositoryInterface
    {
        return $this->purchaseProductRepository;
    }

    public function sales(): SaleRepositoryInterface
    {
        return $this->saleRepository;
    }

    public function brands(): BrandRepositoryInterface
    {
        return $this->brandRepository;
    }

    public function categories(): CategoryRepositoryInterface
    {
        return $this->categoryRepository;
    }

    public function laboratories(): LaboratoryRepositoryInterface
    {
        return $this->laboratoryRepository;
    }

    public function measureUnits(): MeasureUnitRepositoryInterface
    {
        return $this->measureUnitRepository;
    }

    public function utils(): array
    {
        $categories = $this->categories()->get();
        $laboratories = $this->laboratories()->get();
        $brands = $this->brands()->get();
        $measureUnits = $this->measureUnits()->get();
        return [
            'categories' => $categories,
            'laboratories' => $laboratories,
            'brands' => $brands,
            'measureUnits' => $measureUnits,
        ];
    }
}
