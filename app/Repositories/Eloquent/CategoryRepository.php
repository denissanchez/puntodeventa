<?php


namespace App\Repositories\Eloquent;


use App\Repositories\CategoryRepositoryInterface;
use App\Utils\UtilsKey;

class CategoryRepository extends UtilsRepository implements CategoryRepositoryInterface
{
    public function __construct()
    {
        $this->key = UtilsKey::CATEGORY;
    }
}
