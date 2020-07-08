<?php

namespace Tests\Unit;

use App\Repositories\ProductRepositoryInterface;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use Tests\TestCase;

class ProductController extends TestCase
{
    /**
     * @var RepositoryInterface|Mockery\LegacyMockInterface|Mockery\MockInterface
     */
    private $repository;

    public function setUp(): void
    {
        parent::setUp();
        $product_repository = Mockery::mock(ProductRepositoryInterface::class);
        $this->repository = $product_repository;
    }

    public function testExample()
    {
        $product_repository = Mockery::mock(ProductRepositoryInterface::class);
        $product_repository->shouldReceive('all')->once()->andReturn(new Collection());

        $controller = new \App\Http\Controllers\ProductController($product_repository);
        $view = $controller->index();

        $this->assertEquals(new Collection(), $view->getData()['users']);
    }
}
