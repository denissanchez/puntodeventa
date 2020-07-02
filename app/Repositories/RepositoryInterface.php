<?php


namespace App\Repositories;

interface RepositoryInterface
{
    public function products(): ProductRepositoryInterface;
    public function users(): UserRepositoryInterface;
    public function stores(): StoreRepositoryInterface;
    public function purchases(): PurchaseRepositoryInterface;
    public function sales(): SaleRepositoryInterface;
    public function brands(): BrandRepositoryInterface;
    public function categories(): CategoryRepositoryInterface;
    public function laboratories(): LaboratoryRepositoryInterface;
    public function measureUnits(): MeasureUnitRepositoryInterface;
}
