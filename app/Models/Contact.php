<?php

namespace App\Models;

use App\Traits\ContactTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use Notifiable, ContactTrait, SoftDeletes, HasFactory;

    protected $fillable = ['name', 'last_name', 'birtday', 'observations'];
    protected $appends = [];
    protected $hidden = ['deleted_at'];


    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }
}
