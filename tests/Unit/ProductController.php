<?php

namespace Tests\Unit;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;
use Mockery;

class ProductController extends TestCase
{
    /**
     * @var RepositoryInterface|Mockery\LegacyMockInterface|Mockery\MockInterface
     */
    private $repository;
    private \App\Http\Controllers\ProductController $controller;


    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(RepositoryInterface::class);
        $product_repository = Mockery::mock(ProductRepositoryInterface::class);
        $this->repository->shouldReceive('products')->andReturn($product_repository)->once();
        $this->controller = new \App\Http\Controllers\ProductController($this->repository);
    }

    public function testExample()
    {
        $this->repository->products()->shouldReceive('all')->andReturn(new Collection())->once();

        $products = $this->controller->index()->getData('products');

        $this->assertCount(0, $products);
    }
}
