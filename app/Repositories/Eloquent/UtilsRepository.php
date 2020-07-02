<?php


namespace App\Repositories\Eloquent;

use App\Repositories\UtilsRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

abstract class UtilsRepository implements UtilsRepositoryInterface
{
    private string $tableName = "utils";
    protected string $key;

    private function mapCollection(Collection $collection) : array
    {
        return $collection->map(function ($util) {
            return $util->value;
        })->toArray();
    }

    public function get(): array
    {
        $collection = DB::table($this->tableName)->where('key', $this->key)->get();
        return $this->mapCollection($collection);
    }

    /**
     * @inheritDoc
     */
    public function store($value) : void
    {
        DB::table($this->tableName)->insert([
            'key' => $this->key,
            'value' => $value
        ]);
    }

    public function delete($value) : void
    {
        DB::table($this->tableName)->where([
            ['key', '=', $this->key],
            ['value', '=', $value],
        ])->delete();
    }
}
