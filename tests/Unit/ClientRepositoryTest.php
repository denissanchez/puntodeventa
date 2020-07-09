<?php


use App\Models\OwnerDocument;
use App\Repositories\ClientRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class ClientRepositoryTest extends TestCase
{
    private ClientRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(ClientRepositoryInterface::class);
    }

    public function testReturnCollection()
    {
        $this->repository->shouldReceive('all')->once()->andReturn(new Collection([]));
        $clients = $this->repository->all();
        $this->assertEquals(new Collection([]), $clients);
    }

    public function testSearchByName()
    {
        $nameToSearch = "Cliente 1";
        $this->repository->shouldReceive('search')->with($nameToSearch)->once()->andReturn(new Collection([
            new OwnerDocument([
                'name' => $nameToSearch,
                'document' => "12345678",
            ])
        ]));
        $clients = $this->repository->search($nameToSearch);
        $this->assertEquals($nameToSearch, $clients[0]->name);
    }

    public function testSearchByNameIfNotFindElementsReturnsEmptyCollection()
    {
        $nameToSearch = "Cliente 1";
        $this->repository->shouldReceive('search')->with($nameToSearch)->once()->andReturn(new Collection());
        $clients = $this->repository->search($nameToSearch);
        $this->assertCount(0, $clients);
    }

    public function testCreateNewProductPassingAnArray()
    {
        $client = [
            'name' => 'Cliente 1',
            'document' => '12345678965'
        ];
        $this->repository->shouldReceive('create')->with($client)->once()->andReturn(new OwnerDocument($client));
        $this->assertNotNull($this->repository->create($client));
    }

    public function testCreateNewProductAndReturnPivotPassingAnArray()
    {
        $client = [
            'name' => 'Cliente 1',
            'document' => '12345678965'
        ];
        $this->repository->shouldReceive('create')->with($client)->once()->andReturn(new OwnerDocument($client));
        $this->assertNotNull($this->repository->create($client));
    }

    public function testGetAllProducts()
    {
        $clients = factory(OwnerDocument::class, 50)->make();
        $this->repository->shouldReceive('all')->once()->andReturn(new Collection($clients));
        $clients = $this->repository->all();
        $this->assertCount(50, $clients);
    }

    public function testFindProductAndIsFound()
    {
        $client = factory(OwnerDocument::class)->make();
        $this->repository->shouldReceive('find')->with(1)->once()->andReturn(new OwnerDocument($client->toArray()));
        $client_found = $this->repository->find(1);
        $this->assertNotNull($client_found);
        $this->assertEquals($client->name, $client_found->name);
    }

    public function testFindProductAndIsNotFound()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->repository->shouldReceive('find')->with(1)->once()->andReturn(null)->andThrow(new ModelNotFoundException());
        $this->repository->find(1);
    }
}
