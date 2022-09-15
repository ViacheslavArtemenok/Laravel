<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class ResourceQueryBuilder extends AbstractQueryBuilder
{
    private Builder $model;

    public function __construct()
    {
        $this->model = Resource::query();
    }

    public function getAll(): Collection
    {
        return $this->model->get();
    }

    public function getAllPaginate(string $config): LengthAwarePaginator
    {
        return $this->model
            ->paginate(config($config));
    }

    public function getById(int $id): object
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Resource
    {
        return Resource::create($data);
    }


    public function update(object $resource, array $data): bool
    {
        return $resource->fill($data)->save();
    }

    public function delete(object $resource): bool
    {
        return $resource->delete();
    }
}
