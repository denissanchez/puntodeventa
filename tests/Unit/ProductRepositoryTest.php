<?php


use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{

    private ProductRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(ProductRepositoryInterface::class);
    }

    public function testReturnCollection()
    {
        $this->repository->shouldReceive('all')->once()->andReturn(new Collection([]));

        $prducts = $this->repository->all();

        $this->assertEquals(new Collection([]), $prducts);
    }

    public function testSearchByName()
    {
        $nameToSearch = "PRODUCTO";
        $this->repository->shouldReceive('search')->with($nameToSearch)->once()->andReturn(new Collection([
            new Product([
                'name' => $nameToSearch,
            ])
        ]));
        $products = $this->repository->search($nameToSearch);
        $this->assertEquals($nameToSearch, $products[0]->name);
    }

    public function testSearchByInternalCode()
    {
        $codeToSearch = "0487OI";
        $this->repository->shouldReceive('search')->with($codeToSearch)->once()->andReturn(new Collection([
            new Product([
                'internal_code' => $codeToSearch,
            ])
        ]));
        $products = $this->repository->search($codeToSearch);
        $this->assertEquals($codeToSearch, $products[0]->internal_code);
    }

    public function testSearchByNameIfNotFindElementsReturnsEmptyCollection()
    {
        $nameToSearch = "PRODUCTO";
        $this->repository->shouldReceive('search')->with($nameToSearch)->once()->andReturn(new Collection());
        $products = $this->repository->search($nameToSearch);
        $this->assertCount(0, $products);
    }

    public function testCreateNewProductPassingAnArray()
    {
        $product = [
            'name' => 'PRODUCTO CREADO EN UN TEST',
            'unit_price' => 15,
            'minimun_quantity' => 10,
            'measure_unit' => 'UIN',
            'Description' => 'TEST CREATE PRODUCT'
        ];
        $this->repository->shouldReceive('create')->with($product)->once()->andReturn(new Product($product));
        $new_product = $this->repository->create($product);
        $this->assertNotNull($new_product);
    }

    public function testCreateNewProductAndReturnPivotPassingAnArray()
    {
        $product = [
            'name' => 'PRODUCTO CREADO EN UN TEST',
            'unit_price' => 15,
            'minimun_quantity' => 10,
            'measure_unit' => 'UIN',
            'Description' => 'TEST CREATE PRODUCT'
        ];
        $this->repository->shouldReceive('create')->with($product)->once()->andReturn(new Product($product));
        $new_product = $this->repository->create($product);
        $this->assertNotNull($new_product);
    }

    public function testGetAllProducts()
    {
        $products = factory(Product::class, 50)->make();
        $this->repository->shouldReceive('all')->once()->andReturn(new Collection($products));
        $products = $this->repository->all();
        $this->assertCount(50, $products);
    }

    public function testFindProductAndIsFound()
    {
        $product = factory(Product::class)->make();
        $this->repository->shouldReceive('find')->with(1)->once()->andReturn(new Product($product->toArray()));
        $product_found = $this->repository->find(1);
        $this->assertNotNull($product_found);
        $this->assertEquals($product->name, $product_found->name);
    }

    public function testFindProductAndIsNotFound()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->repository->shouldReceive('find')->with(1)->once()->andReturn(null)->andThrow(new ModelNotFoundException());
        $this->repository->find(1);
    }
}
