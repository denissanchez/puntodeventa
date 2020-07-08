<?php


use App\Repositories\LaboratoryRepositoryInterface;
use Tests\TestCase;

class LaboratoryRepositoryTest extends TestCase
{
    private LaboratoryRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(LaboratoryRepositoryInterface::class);
    }

    public function testReturnArray()
    {
        $this->repository->shouldReceive('get')->once()->andReturn([]);
        $laboratories = $this->repository->get();

        $this->assertIsArray($laboratories);
    }

    public function testGetAll()
    {
        $this->repository->shouldReceive('get')->once()->andReturn([
            'LAB1', 'LAB2', 'LAB3'
        ]);
        $laboratories = $this->repository->get();
        $this->assertCount(3, $laboratories);
    }


    public function testStoreLaboratory()
    {
        $laboratory = "LABORATORIO";

        $this->repository->shouldReceive('store')->with($laboratory)->once();
        $this->isNull($this->repository->store($laboratory));
    }

    public function testDeleteLaboratory()
    {
        $laboratory = "LABORATORIO";

        $this->repository->shouldReceive('delete')->with($laboratory)->once();
        $this->isNull($this->repository->delete($laboratory));
    }
}
