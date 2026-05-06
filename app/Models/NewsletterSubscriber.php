<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model
{
    protected $table = 'core_newslettersubscriber';
    protected $fillable = ['email', 'subscribed_at', 'is_active'];
    const CREATED_AT = 'subscribed_at';
    const UPDATED_AT = null;
}
