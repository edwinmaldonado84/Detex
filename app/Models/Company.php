<?php

namespace App\Models;

use App\Traits\CompanyTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use Notifiable, CompanyTrait, SoftDeletes, HasFactory;

    protected $fillable = ['name', 'rfc', 'phone', 'address', 'owner'];
    protected $appends = [];
    protected $hidden = ['deleted_at'];
}
