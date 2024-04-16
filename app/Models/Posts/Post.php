<?php

declare(strict_types=1);

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover',
        'title',
        'description',
        'author_id',
    ];
}
