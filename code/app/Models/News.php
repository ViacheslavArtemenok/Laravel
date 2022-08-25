<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory;
    public const DRAFT = 'DRAFT';
    public const ACTIVE = 'ACTIVE';
    public const BLOCKED = 'BLOCKED';
    protected $table = 'news';
    protected $fields = ['news.id', 'news.category_id', 'news.title', 'news.author_id', 'news.status', 'news.image', 'news.description', 'news.created_at'];

    public function getAllNews(): Collection
    {
        $newFields = ['authors.name AS author_name', 'categories.title AS category_title', 'categories.description AS category_description'];
        $this->fields = array_merge($this->fields, $newFields);
        return DB::table($this->table)
            ->leftJoin('authors', 'authors.id', '=', $this->table . '.author_id')
            ->join('categories', 'categories.id', '=', $this->table . '.category_id')
            ->get($this->fields);
    }

    public function getNews(int $category_id): Collection
    {
        $this->fields[] = 'authors.name AS author_name';
        return DB::table($this->table)
            ->leftJoin('authors', 'authors.id', '=', $this->table . '.author_id')
            ->where('news.category_id', '=', $category_id)
            ->get($this->fields);
    }

    public function getNewsById(int $id): object
    {
        $this->fields[] = 'authors.name AS author_name';
        return DB::table($this->table)
            ->leftJoin('authors', 'authors.id', '=', $this->table . '.author_id')
            ->where('news.id', '=', $id)
            ->get($this->fields);
    }
}
