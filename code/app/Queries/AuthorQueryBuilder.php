<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Author;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class AuthorQueryBuilder extends AbstractQueryBuilder
{
    private Builder $model;

    public function __construct()
    {
        $this->model = Author::query();
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

    public function create(array $data): Author
    {
        return Author::create($data);
    }


    public function update(object $author, array $data): bool
    {
        return $author->fill($data)->save();
    }

    public function delete(object $author): bool
    {
        return $author->delete();
    }
}
