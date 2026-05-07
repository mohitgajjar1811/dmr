<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners_banner';
    protected $fillable = ['title', 'subtitle', 'image', 'btn_text', 'btn_link', 'order', 'is_active'];
    public $timestamps = false;
}
