<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class AuthorQueryBuilder
{
    private Builder $model;

    public function __construct()
    {
        $this->model = Author::query();
    }

    public function getAuthors(string $config): LengthAwarePaginator
    {
        return $this->model
            ->orderBy('name')
            ->paginate(config($config));
    }
    public function getAuthorById(int $id): object
    {
        return $this->model
            ->findOrFail($id);
    }
    public function create(array $data): Author
    {
        return Author::create($data);
    }

    public function update(Author $author, array $data): bool
    {
        return $author->fill($data)->save();
    }

    public function delete(int $id): bool
    {
        $author = $this->model->find($id);
        return $author->delete();
    }
}
