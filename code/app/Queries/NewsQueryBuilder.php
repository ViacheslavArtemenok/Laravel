<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class NewsQueryBuilder
{
    private Builder $model;

    public function __construct()
    {
        $this->model = News::query();
    }

    public function getAllNews(string $config): LengthAwarePaginator
    {
        return $this->model
            ->with('category')
            ->with('author')
            ->paginate(config($config));
    }

    public function getNewsByCategory(int $id, string $config, bool $isAdmin = false): LengthAwarePaginator
    {
        if ($isAdmin) {
            return $this->model
                ->where('category_id', $id)
                ->with('category')
                ->with('author')
                ->paginate(config($config));
        }
        return $this->model
            ->where('category_id', $id)
            ->where('status', News::ACTIVE)
            ->with('category')
            ->with('author')
            ->paginate(config($config));
    }
    public function getNewsById(int $id): object
    {
        return $this->model
            ->with('category')
            ->with('author')
            ->findOrFail($id);
    }
    public function create(array $data): News
    {
        return News::create($data);
    }

    public function update(News $news, array $data): bool
    {
        return $news->fill($data)->save();
    }

    public function delete(int $id): bool
    {
        $news = $this->model->find($id);
        return $news->delete();
    }
}
