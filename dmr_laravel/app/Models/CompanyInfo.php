<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $table = 'core_companyinfo';
    protected $fillable = ['name', 'about_us', 'mission', 'vision', 'address', 'phone', 'email', 'map_embed_code', 'logo', 'favicon', 'header_phone', 'header_email', 'footer_description', 'facebook', 'twitter', 'instagram', 'linkedin', 'youtube'];
    public $timestamps = false;
}
