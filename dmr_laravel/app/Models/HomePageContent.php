<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageContent extends Model
{
    protected $table = 'core_homepagecontent';
    protected $fillable = ['about_title', 'about_content', 'about_image_1', 'about_image_2'];
    public $timestamps = false;
}
