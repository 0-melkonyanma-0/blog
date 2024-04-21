<?php

declare(strict_types=1);

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected  $fillable = [
        'title'
    ];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'title';
    }

    /**
     * @return HasMany
     */
    public function posts(): HasMany {
        return $this->hasMany(Post::class);
    }
}
