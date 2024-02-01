<?php

namespace App\Models;

use App\Models\Enums\StatusProduct;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function scopeActive($query): StatusProduct
    {
        return $query->where('status', 'active');
    }

    public function scopeInactive($query): StatusProduct
    {
        return $query->where('status', 'inactive');
    }
}
