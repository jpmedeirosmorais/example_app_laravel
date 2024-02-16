<?php

namespace App\Models;

use App\Models\Enums\StatusProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property string $id
 * @property string $name
 * @property int $category_id
 * @property float $price
 * @property string $description
 * @property StatusProduct $status
 * @property string $created_at
 * @property string $updated_at
 */
class Product extends Model
{
    use HasFactory, HasUuids;

    protected $casts = [
        'status' => StatusProduct::class,
    ];

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'description',
        'status',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeByStatus(Builder $query, StatusProduct $status): Builder
    {
        return $query->where('status', $status);
    }
}
