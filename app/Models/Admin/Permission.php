<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;
    protected $fillable = ['permission', 'p_component_id'];
    public $dates = ['deleted_at'];
    //Accessor to change the Change Format in Blade View
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('j M, Y');
    }
    public function getDeletedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('j M, Y');
    }

    public function component()
    {
        return $this->belongsTo(PermissionComponent::class, 'p_component_id');
    }
}
