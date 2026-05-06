<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brand extends Model
{
    protected $table = 'brands_brand';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'is_featured',
    ];

    public $timestamps = false; // Django 0001 migration doesn't have created_at/updated_at for Brand

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($brand) {
            if (empty($brand->slug)) {
                $brand->slug = Str::slug($brand->name);
            }
        });
    }
}
