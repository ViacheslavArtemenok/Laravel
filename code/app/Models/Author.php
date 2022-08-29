<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Author extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'text'
    ];
    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }
}
