<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{

	use SoftDeletes;
	public $dates = ['deleted_at'];

    protected $fillable = [
    	'fullName', 'email', 'contact', 'message', 'budgetLevel'
    ];

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('j M, Y');
    }
    public function getDeletedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('j M, Y');
    }
}
