<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;


class PermissionComponent extends Model
{
    protected $fillable = ['component'];
    public $timestamps = false;

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
