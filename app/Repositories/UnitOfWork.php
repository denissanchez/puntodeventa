<?php


namespace App\Repositories;


class UnitOfWork
{
    public UserRepositoryInterface $userRepository;
    public ProductRepositoryInterface $productRepository;
    public UtilsRepositoryInterface $utilsRepository;
    public StoreRepositoryInterface $storeRepository;
    public PurchaseRepositoryInterface $purchaseRepository;
    public SaleRepositoryInterface $saleRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        ProductRepositoryInterface $productRepository,
        UtilsRepositoryInterface $utilsRepository,
        StoreRepositoryInterface $storeRepository,
        PurchaseRepositoryInterface $purchaseRepository,
        SaleRepositoryInterface $saleRepository
    ) {
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->utilsRepository = $utilsRepository;
        $this->storeRepository = $storeRepository;
        $this->purchaseRepository = $purchaseRepository;
        $this->saleRepository = $saleRepository;
    }
}
