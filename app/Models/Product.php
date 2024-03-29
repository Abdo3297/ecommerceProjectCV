<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia;

    protected $fillable = [
        'name',
        'price',
        'category_id'
    ];
    // relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function orders() :HasMany
    {
        return $this->hasMany(Order::class);
    }
    // collection of spatie media
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_image');
    }
}
