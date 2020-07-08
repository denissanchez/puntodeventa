<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

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
    private ProviderRepositoryInterface $providerRepository;
    private ClientRepositoryInterface $clientRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        PurchaseRepositoryInterface $purchaseRepository,
        SaleRepositoryInterface $saleRepository,
        StoreRepositoryInterface $storeRepository,
        UserRepositoryInterface $userRepository,
        BrandRepositoryInterface $brandRepository,
        CategoryRepositoryInterface $categoryRepository,
        LaboratoryRepositoryInterface $laboratoryRepository,
        MeasureUnitRepositoryInterface $measureUnitRepository,
        ProviderRepositoryInterface $providerRepository,
        ClientRepositoryInterface $clientRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->purchaseProductRepository = $purchaseRepository;
        $this->saleRepository = $saleRepository;
        $this->storeRepository = $storeRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->laboratoryRepository = $laboratoryRepository;
        $this->measureUnitRepository = $measureUnitRepository;
        $this->providerRepository = $providerRepository;
        $this->clientRepository = $clientRepository;
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

    public function providers(): ProviderRepositoryInterface
    {
        return $this->providerRepository;
    }

    public function clients(): ClientRepositoryInterface
    {
        return $this->clientRepository;
    }

    public function utils(): array
    {

    }

    public function owners(): Collection
    {
        $clients = $this->clientRepository->all();
        $providers = $this->providerRepository->all();
        return $clients->merge($providers);
    }
}
