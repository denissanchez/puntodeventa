<?php

namespace Tests\Unit;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use PHPUnit\Framework\TestCase;

class ProductsTest extends TestCase
{
    private RepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(RepositoryInterface::class);
        $product_repository = Mockery::mock(ProductRepositoryInterface::class);

    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    public function testSetOriginCodeIfNotAssigned()
    {
        $products = $this->repository->products()->all();
        $this->assertInstanceOf($products, Collection::class);
    }
}
