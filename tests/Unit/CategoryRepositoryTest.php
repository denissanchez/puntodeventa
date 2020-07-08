<?php


use App\Repositories\CategoryRepositoryInterface;
use Tests\TestCase;

class CategoryRepositoryTest extends TestCase
{
    private CategoryRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(CategoryRepositoryInterface::class);
    }

    public function testReturnArray()
    {
        $this->repository->shouldReceive('get')->once()->andReturn([]);
        $categories = $this->repository->get();

        $this->assertIsArray($categories);
    }


    public function testGetAll()
    {
        $this->repository->shouldReceive('get')->once()->andReturn([
            'CAT1', 'CAT2', 'CAT3'
        ]);
        $categories = $this->repository->get();
        $this->assertCount(3, $categories);
    }


    public function testStoreCategory()
    {
        $category = "CATEGORIA";

        $this->repository->shouldReceive('store')->with($category)->once();
        $new_category = $this->repository->store($category);
        $this->isNull($new_category);
    }

    public function testDeleteCategory()
    {
        $category = "CATEGORIA";

        $this->repository->shouldReceive('delete')->with($category)->once();
        $category_deleted = $this->repository->delete($category);
        $this->isNull($category_deleted);
    }

}
