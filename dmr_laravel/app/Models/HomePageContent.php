<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageContent extends Model
{
    protected $table = 'core_homepagecontent';
    protected $fillable = ['hero_fallback_title', 'hero_fallback_text', 'features_section_enabled', 'featured_products_title', 'featured_products_subtitle', 'brands_title', 'cta_title', 'cta_text', 'cta_btn_text', 'cta_btn_link', 'cta_background_image'];
    public $timestamps = false;
}
