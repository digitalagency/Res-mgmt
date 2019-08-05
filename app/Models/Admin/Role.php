<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = ['role'];
}
