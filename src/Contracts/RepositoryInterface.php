<?php

namespace Mitul456\LaravelRepositoryService\Contracts;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function all(Model $model);
    public function find(Model $model, $id);
    public function create(Model $model, array $data);
    public function update(Model $model, $id, array $data);
    public function delete(Model $model, $id);
}