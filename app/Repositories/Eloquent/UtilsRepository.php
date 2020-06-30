<?php


namespace App\Repositories\Eloquent;


use App\Repositories\UtilsRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UtilsRepository implements UtilsRepositoryInterface
{
    private $tableName;

    public function __construct()
    {
        $this->tableName = 'utils';
    }

    private function mapCollection(Collection $collection) : array
    {
        return $collection->map(function ($util) {
            return $util->value;
        })->toArray();
    }

    public function get($key): array
    {
        $collection = DB::table($this->tableName)->where('key', '=', $key)->get();
        return $this->mapCollection($collection);
    }

    /**
     * @inheritDoc
     */
    public function store($key, $value)
    {
        DB::table($this->tableName)->insert([
            'key' => $key,
            'value' => $value
        ]);
    }

    /**
     * @inheritDoc
     */
    public function delete($key, $value)
    {
        DB::table($this->tableName)->where([
            ['key', '=', $key],
            ['value', '=', $value],
        ])->delete();
    }

    /**
     * @inheritDoc
     */
    public function find($key, $value): string
    {
        $util = DB::table($this->tableName)->where([
            ['key', '=', $key],
            ['value', '=', $value],
        ])->first();

        return $util->value;
    }

    /**
     * @inheritDoc
     */
    public function edit($key, $value): string
    {
        // TODO: Implement edit() method.
    }
}
