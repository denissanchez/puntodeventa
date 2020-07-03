<?php


namespace App\Repositories\Eloquent;


use App\Repositories\ClientRepositoryInterface;
use App\Utils\UtilsKey;
use Illuminate\Database\Eloquent\Model;

class ClientRepository extends OwnerDocumentRepository implements ClientRepositoryInterface
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->type = UtilsKey::PERSONA_NATURAL;
    }
}
