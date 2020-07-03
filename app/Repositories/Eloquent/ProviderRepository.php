<?php


namespace App\Repositories\Eloquent;


use App\Repositories\ProviderRepositoryInterface;
use App\Utils\UtilsKey;
use Illuminate\Database\Eloquent\Model;

class ProviderRepository extends OwnerDocumentRepository implements ProviderRepositoryInterface
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->type = UtilsKey::PERSONA_JURIDICA;
    }
}
