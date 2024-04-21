<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    public function viewable(): MorphTo {
        return $this->morphTo();
    }
}
