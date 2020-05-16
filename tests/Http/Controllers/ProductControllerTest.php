<?php

namespace Tests\Http\Controllers;

use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use Tests\TestCase;
use Mockery;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;

class ProductControllerTest extends TestCase
{
    public function testGetLastTenRegisteredProducts()
    {

    }

    public function testSearchProductByName_IfNameIsNullReturnZeroProducts()
    {
        // var mock = new Mock<IProductRepository>();
        $mock = Mockery::mock(ProductRepositoryInterface::class);
        // mock = mock.Setup(o => o.Find).Returns([...respuesta])
        $mock->shouldReceive('all')->once()->andReturn([]);

        $controller = new ProductController($mock);
        $view = $controller->index();
        $this->assertEquals([], $view->getData()['products']);
    }

    public function testSearchProductByInternalCode()
    {

    }

    public function testSearchProductByExternalCode()
    {

    }

    public function testGetMessageWhenNotExistsProducts() {

    }
}
