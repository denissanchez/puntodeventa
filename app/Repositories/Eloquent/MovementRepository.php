<?php


namespace App\Repositories\Eloquent;

use App\Models\OwnerDocument;
use App\Utils\MovementType;
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
        if (!isset($attributes['owner_id'])) {
            $client_type = UtilsKey::PERSONA_NATURAL;

            if (strlen($attributes['client']['document']) == 11) {
                $client_type = UtilsKey::PERSONA_JURIDICA;
            }

            $owner = OwnerDocument::updateOrCreate([
                'document' => $attributes['client']['document']
            ], [
                'name' => $attributes['client']['name'],
                'address' => $attributes['client']['address'],
                'type' => $client_type,
            ]);

            $owner_id = $owner->id;
        } else {
            $owner_id = $attributes['owner_id'];
        }


        $attributes = array_merge($attributes, [
            'store_id' => session(UtilsKey::CURRENT_STORE_ID),
            'owner_id' => $owner_id,
            'seller_id' => Auth::id(),
            'document' => str_pad(rand(1, 99999), 8, "0", STR_PAD_LEFT),
            'document_type' => UtilsKey::FACTURA,
            'state' => UtilsKey::DOCUMENT_STATE_STORED,
            'type' => $this->type,
        ]);
        return parent::create($attributes);
    }
}
