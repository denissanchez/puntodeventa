<?php


namespace App\Repositories;

interface UtilsRepositoryInterface
{
    public function get($key): array;

    /**
     * @param $key
     * @param $name
     * @return string
     */
    public function store($key, $name): string;

    /**
     * @param $key
     * @param $name
     * @return void
     */
    public function delete($key, $name);

    /**
     * @param $key
     * @param $name
     * @return array
     */
    public function find($key, $name): array;

    /**
     * @param $key
     * @param $name
     * @return string
     */
    public function edit($key, $name): string;
}
