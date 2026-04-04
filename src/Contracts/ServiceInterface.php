<?php

namespace Mitul456\LaravelRepositoryService\Contracts;

interface ServiceInterface
{
    public function getAll($model);
    public function find($model, $id);
}