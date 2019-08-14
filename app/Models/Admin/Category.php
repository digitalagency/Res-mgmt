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
}
