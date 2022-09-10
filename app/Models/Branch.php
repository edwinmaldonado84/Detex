<?php

namespace App\Models;

use App\Traits\BranchTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use Notifiable, BranchTrait, SoftDeletes;

    protected $fillable = ['name', 'rfc', 'phone', 'address', 'owner', 'company_id'];
    protected $appends = [];
    protected $hidden = ['deleted_at'];
}
