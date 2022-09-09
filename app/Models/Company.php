<?php

namespace App\Models;

use App\Traits\CompanyTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use Notifiable, CompanyTrait;

    protected $fillable = ['name', 'rfc', 'phone', 'address', 'owner'];
    protected $appends = [];
    protected $hidden = ['deleted_at'];
}
