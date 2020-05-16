<?php


namespace Tests\Http\Controllers;


use App\Http\Controllers\UserController;
use App\Repositories\UserRepositoryInterface;
use Tests\TestCase;
use Mockery;

class UserControllerTest extends TestCase
{
    public function testGetAllUsers()
    {
        $mock = Mockery::mock(UserRepositoryInterface::class);
        $mock->shouldReceive('all')->once()->andReturn([]);

        $controller = new UserController($mock);
        $view = $controller->index();

        $this->assertEquals([], $view->getData()['users']);
    }
}
