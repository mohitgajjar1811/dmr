<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPageContent extends Model
{
    protected $table = 'core_aboutpagecontent';
    protected $fillable = ['subtitle', 'title', 'content', 'quote', 'cta_title'];
    public $timestamps = false;
}
