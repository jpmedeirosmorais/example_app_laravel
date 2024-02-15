<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends Model
{

    use HasFactory, HasUuids;

    protected $fillable = ['name', 'slug'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function slug(): string
    {
         return $this->slug = Str::slug($this->name, '-');
    }
}
