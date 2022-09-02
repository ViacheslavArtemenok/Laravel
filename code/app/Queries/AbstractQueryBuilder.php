<?php

declare(strict_types=1);

namespace App\Queries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class AbstractQueryBuilder
{
    abstract public function getAll(): Collection;


    abstract public function getAllPaginate(string $config): LengthAwarePaginator;


    abstract public function getById(int $id): object;


    abstract public function create(array $data): Model;


    abstract public function update(object $model, array $data): bool;


    abstract public function delete(object $author): bool;
}
