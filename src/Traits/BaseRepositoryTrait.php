<?php

namespace Mitul456\LaravelRepositoryService\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

trait BaseRepositoryTrait
{
    protected Model $model;

    public function all(array $columns = ['*']): Collection
    {
        return $this->model->get($columns);
    }

    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function findOrFail($id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update($id, array $data): Model
    {
        $record = $this->findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete($id): bool
    {
        return $this->findOrFail($id)->delete();
    }

    public function paginate($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }
}