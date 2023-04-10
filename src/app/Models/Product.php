<?php

namespace App\Models;

use App\Events\Model\ProductDeletedEvent;
use App\Events\Model\ProductSavedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
    ];

    protected $dispatchesEvents = [
        'saved' => ProductSavedEvent::class,
        'deleted' => ProductDeletedEvent::class,
    ];


    public function relCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
