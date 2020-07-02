<?php


namespace App\Repositories\Eloquent;


use App\Repositories\LaboratoryRepositoryInterface;
use App\Utils\UtilsKey;

class LaboratoryRepository extends UtilsRepository implements LaboratoryRepositoryInterface
{
    public function __construct()
    {
        $this->key = UtilsKey::LABORATORY;
    }
}
