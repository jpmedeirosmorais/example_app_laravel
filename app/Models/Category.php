<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name'];

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }

    protected function name(): Attribute
    {
        $this->setSlug($this->attributes->get('name'));

        return Attribute::make(
            get: fn ($value) => Str::title($value),
            set: fn ($value) => Str::title($value)
        );
    }

    protected function setSlug($name): void
    {
        $this->attributes['slug'] = Str::slug($name);
    }





}
