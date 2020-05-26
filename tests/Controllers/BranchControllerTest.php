<?php


namespace Tests\Controllers;


use App\Http\Controllers\BranchController;
use App\Models\Branch;
use App\Repositories\BranchRepositoryInterface;
use Tests\TestCase;
use Mockery;


class BranchControllerTest extends TestCase
{
    public function testGetProducts()
    {
        $repository = Mockery::mock(BranchRepositoryInterface::class);
        $repository->shouldReceive("all")->once()->andReturn([]);
        $controller = new BranchController($repository);
        $response = $controller->index();
        $this->assertEquals([], $response->getData()['branches']);
    }

    public function testGetOnlyOneProduct()
    {
        $branch = factory(Branch::class)->make();

        $repository = Mockery::mock(BranchRepositoryInterface::class);
        $repository->shouldReceive("get")->with($branch->id)->once()->andReturn($branch);

        $controller = new BranchController($repository);
        $response = $controller->show($branch->id);
        $this->assertEquals($branch, $response->getData()['branch']);
    }
}
