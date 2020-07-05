<?php


namespace App\Repositories\Eloquent;

use App\Repositories\OwnerDocumentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class OwnerDocumentRepository extends BaseRepository implements OwnerDocumentRepositoryInterface
{
    protected string $type;

    public function all(): Collection
    {
        return $this->model->where('type', $this->type)->get();
    }

    public function create(array $attributes): Model
    {
        $attributes = [...$attributes, 'type' => $this->type];
        parent::create($attributes);
    }

    public function search($value): Collection
    {
        return $this->model->where('type', $this->type)
            ->where(function ($query) use ($value) {
                $query->where('name', 'LIKE', '%'.$value.'%');
                $query->orWhere('document', 'LIKE', '%'.$value.'%');
            })->get();
    }
}
