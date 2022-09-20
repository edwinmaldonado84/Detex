<?php

namespace App\Models;

use App\Models\Company;
use App\Traits\GroupTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use Notifiable, GroupTrait, SoftDeletes, HasFactory;

    protected $fillable = ['name'];
    protected $appends = [];
    protected $hidden = ['deleted_at', 'pivot'];

    public function companies()
    {
        return $this->hasMany(Company::class, 'group_id', 'id');
    }
}
