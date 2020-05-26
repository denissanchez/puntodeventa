<?php


namespace Tests\Controllers;


use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductController as API_ProductController;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Tests\TestCase;
use Mockery;

class ProductControllerTest extends TestCase
{
    public function testGetProducts()
    {
        $repository = Mockery::mock(ProductRepositoryInterface::class);
        $repository->shouldReceive("all")->once()->andReturn([]);
        $controller = new ProductController($repository);
        $response = $controller->index();
        $this->assertEquals([], $response->collection->toArray());
    }


    public function testSaveProductWhenIsCorrectData()
    {
        $product = factory(Product::class)->make();

        $repository = Mockery::mock(ProductRepositoryInterface::class);
        $repository->shouldReceive("save")->with($product->toArray())->once()->andReturn($product);

        $controller = new API_ProductController($repository);
        $response = $controller->store($product->toArray());
        $this->assertEquals($product, $response->resource);
    }

    public function testGetOnlyOneProduct()
    {
        $product = factory(Product::class)->make();

        $repository = Mockery::mock(ProductRepositoryInterface::class);
        $repository->shouldReceive("get")->with($product->id)->once()->andReturn($product);

        $controller = new API_ProductController($repository);
        $response = $controller->show($product->id);
        $this->assertEquals($product, $response->resource);
    }
}
