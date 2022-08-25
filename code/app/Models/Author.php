<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class Author extends Model
{
    use HasFactory;
    protected $table = 'authors';
    protected $fields = ['id', 'name', 'phone', 'email', 'text', 'created_at'];

    public function getAuthors(): Collection
    {
        return DB::table($this->table)->get($this->fields);
    }
    public function getAuthorById(int $id): object
    {
        return DB::table($this->table)
            ->where('id', '=', $id)
            ->get($this->fields);
    }
}
