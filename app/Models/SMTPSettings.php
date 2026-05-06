<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMTPSettings extends Model
{
    protected $table = 'core_smtpsettings';
    protected $fillable = ['email_host', 'email_port', 'email_host_user', 'email_host_password', 'email_use_tls', 'email_use_ssl', 'default_from_email'];
    public $timestamps = false;
}
