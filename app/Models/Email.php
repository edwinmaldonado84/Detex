<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    use Notifiable,  SoftDeletes, HasFactory;

    protected $fillable = ['email', 'contact_id'];
    protected $appends = [];
    protected $hidden = ['deleted_at'];
}
