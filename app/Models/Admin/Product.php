<?php

namespace App;
namespace App\Models\Admin;
use App\Models\Admin\Category;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	protected $fillable = [

		'name', 'price', 'description', 'slug', 'category_id','status','featured','image',
	];

    public function category(){

    	return $this->belongsTo(Category::class);

    }
}
