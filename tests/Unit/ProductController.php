<?php

namespace Tests\Unit;

use App\Providers\AppServiceProvider;
use App\Providers\ProductServiceProvider;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\ViewServiceProvider;
use Mockery;
use Orchestra\Testbench\TestCase;

class ProductController extends TestCase
{
    /**
     * @var RepositoryInterface|Mockery\LegacyMockInterface|Mockery\MockInterface
     */
    private $repository;


    protected function getPackageProviders($app)
    {
        return [ProductServiceProvider::class];
    }

    protected function setUp(): void
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



        $this->assertCount(0, $products);
    }
}
