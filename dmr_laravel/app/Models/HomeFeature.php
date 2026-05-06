<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeFeature extends Model
{
    protected $table = 'core_homefeature';
    protected $fillable = ['icon', 'title', 'subtitle', 'order'];
    public $timestamps = false;
}
