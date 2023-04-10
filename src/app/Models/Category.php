<?php

namespace App\Models;

use App\Events\Model\CategoryDeletedEvent;
use App\Events\Model\CategorySavedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'index',
        'name',
    ];

    protected $dispatchesEvents = [
        'saved' => CategorySavedEvent::class,
        'deleted' => CategoryDeletedEvent::class,
    ];

    public function relParent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function relChildren(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id')->orderBy('index', 'ASC');
    }

    public function relProducts(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
