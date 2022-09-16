<?php

namespace App\Models;

use App\Traits\ChargeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Charge extends Model
{
    use Notifiable, ChargeTrait, SoftDeletes, HasFactory;

    protected $fillable = ['name', 'description'];
    protected $appends = [];
    protected $hidden = ['deleted_at'];
}
