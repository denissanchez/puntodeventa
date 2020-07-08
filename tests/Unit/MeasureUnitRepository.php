<?php


use App\Repositories\MeasureUnitRepositoryInterface;
use Tests\TestCase;

class MeasureUnitRepository extends TestCase
{
    private MeasureUnitRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(MeasureUnitRepositoryInterface::class);
    }

    public function testReturnArray()
    {
        $this->repository->shouldReceive('get')->once()->andReturn([]);
        $measure_units = $this->repository->get();

        $this->assertIsArray($measure_units);
    }

    public function testGetAll()
    {
        $this->repository->shouldReceive('get')->once()->andReturn([
            'UOM1', 'UOM2', 'UOM3', 'UOM4'
        ]);
        $measure_units = $this->repository->get();
        $this->assertCount(4, $measure_units);
    }


    public function testStoreMeasureUnit()
    {
        $measure_unit = "MEASURE_UNIT";

        $this->repository->shouldReceive('store')->with($measure_unit)->once();
        $this->isNull($this->repository->store($measure_unit));
    }

    public function testDeleteMeasureUnit()
    {
        $measure_unit = "MEASURE_UNIT";

        $this->repository->shouldReceive('delete')->with($measure_unit)->once();
        $this->isNull($this->repository->delete($measure_unit));
    }
}
