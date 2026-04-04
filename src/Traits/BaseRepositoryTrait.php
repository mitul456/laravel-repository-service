<?php

namespace Mitul456\LaravelRepositoryService\Traits;

use Mitul456\LaravelRepositoryService\Contracts\RepositoryInterface;

trait BaseRepositoryTrait
{
    public function all($model)
    {
        return $model->all();
    }

    public function find($model, $id)
    {
        return $model->find($id);
    }

    public function create($model, array $data)
    {
        return $model->create($data);
    }

    public function update($model, $id, array $data)
    {
        $record = $model->find($id);
        if ($record) {
            $record->update($data);
        }
        return $record;
    }

    public function delete($model, $id)
    {
        $record = $model->find($id);
        if ($record) {
            $record->delete();
        }
        return $record;
    }
}