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
        $mock = Mockery::mock(ProductRepositoryInterface::class);
        $mock->shouldReceive('find')->with(null)->once()->andReturn([]);

        $controller = new ProductController($mock);
        $view = $controller->index();
        $controller->index();
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
