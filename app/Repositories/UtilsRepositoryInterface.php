<?php


namespace App\Repositories;

interface UtilsRepositoryInterface
{
    public function get($key): array;

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function store($key, $value);

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function delete($key, $value);

    /**
     * @param $key
     * @param $value
     * @return string
     */
    public function find($key, $value): string;

    /**
     * @param $key
     * @param $value
     * @return string
     */
    public function edit($key, $value): string;
}
