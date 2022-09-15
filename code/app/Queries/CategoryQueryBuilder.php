<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

final class CategoryQueryBuilder extends AbstractQueryBuilder
{
    private Builder $model;

    public function __construct()
    {
        $this->model = Category::query();
    }
    /**
     * getAllWithoutPaginate()
     * Переопределяет метод getAll
     * @return Collection
     * 
     */
    public function getAll(): Collection
    {
        return $this->model->get();
    }
    public function getAllPaginate(string $config): LengthAwarePaginator
    {
        return $this->model->paginate(config($config));
    }
    public function getById(int $id): object
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(object $category, array $data): bool
    {
        return $category->fill($data)->save();
    }

    public function delete(object $category): bool
    {
        return $category->delete();
    }
}
