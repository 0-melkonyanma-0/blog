<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $viewable_id
 * @property string $viewable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $viewable
 * @method static \Illuminate\Database\Eloquent\Builder|View newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|View newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|View query()
 * @method static \Illuminate\Database\Eloquent\Builder|View whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|View whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|View whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|View whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|View whereViewableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|View whereViewableType($value)
 * @mixin \Eloquent
 */
class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    /**
     * @return MorphTo
     */
    public function viewable(): MorphTo {
        return $this->morphTo();
    }
}
