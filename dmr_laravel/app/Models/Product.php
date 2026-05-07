<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'products_product';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'main_image',
        'pdf_brochure',
        'is_featured',
        'is_active',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}
