<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

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

    public function providers(): ProviderRepositoryInterface;

    public function clients(): ClientRepositoryInterface;

    public function utils(): array;

    public function owners(): Collection;
}
