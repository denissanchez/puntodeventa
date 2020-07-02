<?php


namespace App\Repositories\Eloquent;


use App\Repositories\MeasureUnitRepositoryInterface;
use App\Utils\UtilsKey;

class MeasureUnitRepository extends UtilsRepository implements MeasureUnitRepositoryInterface
{
    public function __construct()
    {
        $this->key = UtilsKey::MEASURE_UNIT;
    }
}
