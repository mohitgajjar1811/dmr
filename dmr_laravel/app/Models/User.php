<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'auth_user';

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'is_superuser',
        'is_staff',
        'is_active',
        'date_joined',
        'last_login',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false; // Django handles these fields differently

    /**
     * Get the name for the user (mapping Django first_name + last_name to Laravel's name concept)
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Check if user is an admin (superuser in Django)
     */
    public function isAdmin()
    {
        return $this->is_superuser;
    }
}
