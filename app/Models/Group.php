<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'groupImage', 'slug', 'description', 'owner_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_users')
                    ->withPivot('status', 'role')
                    ->withTimestamps();
    }
}
