<?php


namespace App\Repositories\Eloquent;

use App\Utils\UtilsKey;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

abstract class MovementRepository extends BaseRepository
{
    protected string $type;

    public function all(): Collection
    {
        $movements = parent::all();
        return $movements->filter(function ($movement) {
            return $movement->type === $this->type;
        });
    }

    public function create(array $attributes): Model
    {
        $attributes = array_merge($attributes, [
            'store_id' => session(UtilsKey::CURRENT_STORE_ID),
            'seller_id' => Auth::id(),
            'document_type' => UtilsKey::FACTURA,
            'state' => UtilsKey::DOCUMENT_STATE_STORED,
            'type' => $this->type,
        ]);
        return parent::create($attributes);
    }
}
