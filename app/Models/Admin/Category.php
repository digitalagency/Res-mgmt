<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;

class Category extends Model
{


	protected $fillable = [
		'name', 
		'slug',
		'parent_id'
	];

    public function products(){

    	return $this->hasMany(Product::class);

	}
	public function getNameAttribute($value)
	{
		return ucwords($value);
	}
	public function getCreatedAtAttribute($value)
	{
		return \Carbon\Carbon::parse($value)->format('j M, Y');
	}
}
