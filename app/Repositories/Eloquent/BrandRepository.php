<?php


namespace App\Repositories\Eloquent;


use App\Repositories\BrandRepositoryInterface;
use App\Utils\UtilsKey;

class BrandRepository extends UtilsRepository implements BrandRepositoryInterface
{
    public function __construct()
    {
        $this->key = UtilsKey::BRAND;
    }
}
