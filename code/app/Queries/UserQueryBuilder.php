<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class UserQueryBuilder extends AbstractQueryBuilder
{
    private Builder $model;

    public function __construct()
    {
        $this->model = User::query();
    }

    public function getAll(): Collection
    {
        return $this->model->get();
    }

    public function getAllPaginate(string $config): LengthAwarePaginator
    {
        return $this->model
            ->orderBy('name')
            ->paginate(config($config));
    }

    public function getById(int $id): object
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }


    public function update(object $user, array $data): bool
    {
        return $user->fill($data)->save();
    }

    public function delete(object $user): bool
    {
        return $user->delete();
    }
}
