<?php


use App\Models\OwnerDocument;
use App\Repositories\ProviderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class ProviderRepositoryTest extends TestCase
{
    private ProviderRepositoryInterface $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = Mockery::mock(ProviderRepositoryInterface::class);
    }

    public function testReturnCollection()
    {
        $this->repository->shouldReceive('all')->once()->andReturn(new Collection([]));
        $providers = $this->repository->all();
        $this->assertEquals(new Collection([]), $providers);
    }

    public function testSearchByName()
    {
        $nameToSearch = "Proveedor 1";
        $this->repository->shouldReceive('search')->with($nameToSearch)->once()->andReturn(new Collection([
            new OwnerDocument([
                'name' => $nameToSearch,
                'document' => "12345678457",
            ])
        ]));
        $providers = $this->repository->search($nameToSearch);
        $this->assertEquals($nameToSearch, $providers[0]->name);
    }

    public function testSearchByNameIfNotFindElementsReturnsEmptyCollection()
    {
        $nameToSearch = "Cliente 1";
        $this->repository->shouldReceive('search')->with($nameToSearch)->once()->andReturn(new Collection());
        $providers = $this->repository->search($nameToSearch);
        $this->assertCount(0, $providers);
    }

    public function testCreateNewProductPassingAnArray()
    {
        $provider = [
            'name' => 'Proveedor 1',
            'document' => '12345678457'
        ];
        $this->repository->shouldReceive('create')->with($provider)->once()->andReturn(new OwnerDocument($provider));
        $this->assertNotNull($this->repository->create($provider));
    }

    public function testCreateNewProductAndReturnPivotPassingAnArray()
    {
        $provider = [
            'name' => 'Proveedor 1',
            'document' => '12345678457'
        ];
        $this->repository->shouldReceive('create')->with($provider)->once()->andReturn(new OwnerDocument($provider));
        $this->assertNotNull($this->repository->create($provider));
    }

    public function testGetAllProducts()
    {
        $providers = factory(OwnerDocument::class, 50)->make();
        $this->repository->shouldReceive('all')->once()->andReturn(new Collection($providers));
        $providers = $this->repository->all();
        $this->assertCount(50, $providers);
    }

    public function testFindProductAndIsFound()
    {
        $provider = factory(OwnerDocument::class)->make();
        $this->repository->shouldReceive('find')->with(1)->once()->andReturn(new OwnerDocument($provider->toArray()));
        $provider_found = $this->repository->find(1);
        $this->assertNotNull($provider_found);
        $this->assertEquals($provider->name, $provider_found->name);
    }

    public function testFindProductAndIsNotFound()
    {
        $this->expectException(ModelNotFoundException::class);
        $this->repository->shouldReceive('find')->with(1)->once()->andReturn(null)->andThrow(new ModelNotFoundException());
        $this->repository->find(1);
    }
}
