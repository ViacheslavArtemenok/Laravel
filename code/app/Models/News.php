<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class News extends Model
{
    use HasFactory;
    public const DRAFT = 'DRAFT';
    public const ACTIVE = 'ACTIVE';
    public const BLOCKED = 'BLOCKED';
    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'status',
        'image',
        'description',
        'link',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
