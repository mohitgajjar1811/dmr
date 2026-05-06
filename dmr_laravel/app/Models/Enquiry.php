<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table = 'enquiries_enquiry';

    protected $fillable = [
        'name',
        'company_name',
        'email',
        'phone',
        'state',
        'city',
        'message',
        'is_read',
        'is_replied',
        'reply_message',
        'replied_at',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null; // Enquiry has created_at but no updated_at in Django model
}
