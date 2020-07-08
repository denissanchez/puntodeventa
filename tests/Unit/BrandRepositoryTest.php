<?php


use App\Repositories\BrandRepositoryInterface;
use Tests\TestCase;

class BrandRepositoryTest extends TestCase
{
    private BrandRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(BrandRepositoryInterface::class);
    }

    public function testReturnArray()
    {
        $this->repository->shouldReceive('get')->once()->andReturn([]);
        $brands = $this->repository->get();
        $this->assertIsArray($brands);
    }


    public function testGetAll()
    {
        $this->repository->shouldReceive('get')->once()->andReturn([
            'BRAND1', 'BRAND2', 'BRAND3'
        ]);
        $brands = $this->repository->get();
        $this->assertCount(3, $brands);
    }


    public function testStoreCategory()
    {
        $brand = "CATEGORIA";

        $this->repository->shouldReceive('store')->with($brand)->once();
        $new_brand = $this->repository->store($brand);
        $this->isNull($new_brand);
    }

    public function testDeleteCategory()
    {
        $brand = "CATEGORIA";

        $this->repository->shouldReceive('delete')->with($brand)->once();
        $brand_deleted = $this->repository->delete($brand);
        $this->isNull($brand_deleted);
    }
}
