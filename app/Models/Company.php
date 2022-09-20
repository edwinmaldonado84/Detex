<?php

namespace App\Models;

use App\Models\Group;
use App\Traits\CompanyTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use Notifiable, CompanyTrait, SoftDeletes, HasFactory;

    protected $fillable = ['name', 'business_name', 'rfc', 'webpage', 'observations', 'group_id'];
    protected $appends = [];
    protected $hidden = ['deleted_at', 'pivot'];


    public function group()
    {
        return $this->hasOne(Group::class, 'id', 'group_id')->select(['id', 'name']);
    }
}
