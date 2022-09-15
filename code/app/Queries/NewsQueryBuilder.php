<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class NewsQueryBuilder extends AbstractQueryBuilder
{
    private Builder $model;

    public function __construct()
    {
        $this->model = News::query();
    }

    public function getAll(): Collection
    {
        return $this->model->get();
    }

    public function getAllPaginate(string $config): LengthAwarePaginator
    {
        return $this->model
            ->orderBy('category_id')
            ->with(['category', 'author'])
            ->paginate(config($config));
    }

    public function getByCategoryPaginate(int $id, string $config, bool $isAdmin = false): LengthAwarePaginator
    {
        if ($isAdmin) {
            return $this->model
                ->where('category_id', $id)
                ->orderBy('author_id')
                ->with(['category', 'author'])
                ->paginate(config($config));
        }
        return $this->model
            ->where('category_id', $id)
            ->where('status', News::ACTIVE)
            ->with(['category', 'author'])
            ->paginate(config($config));
    }

    public function getById(int $id): object
    {
        return $this->model
            ->with(['category', 'author'])
            ->findOrFail($id);
    }
    public function create(array $data): News
    {
        return News::create($data);
    }

    public function update(object $news, array $data): bool
    {
        return $news->fill($data)->save();
    }

    public function delete(object $news): bool
    {
        return $news->delete();
    }
}
