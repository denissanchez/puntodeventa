<?php


namespace App\Repositories;


interface UtilsRepositoryInterface
{
    /**
     * @return array
     */
    public function get() : array;

    /**
     * @param $value
     */
    public function store($value) : void;

    /**
     * @param $value
     */
    public function delete($value) : void;
}
