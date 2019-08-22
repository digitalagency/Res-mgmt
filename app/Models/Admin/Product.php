<?php

namespace App;
namespace App\Models\Admin;
use App\Models\Admin\Category;

use Illuminate\Database\Eloquent\Model;
use Gate;

class Product extends Model
{

	protected $fillable = [

		'name', 'price', 'description', 'slug', 'category_id','status','featured','image',
	];

	//Change value while displying to admin using mutators
	// public function getStatusAttribute($value){
	// 	return $this->checkBoolean($value);
	// }
	// public function getFeaturedAttribute($value)
	// {
	// 	return $this->checkBoolean($value);
	// } 
	//Add a prefix to a price column data before displaying to a user
	public function getPriceAttribute($value){
		if(Gate::allows('prodict-view')){
			return 'Rs. ' . $value;
		}
		else{
			return $value;
		}
	}

    public function category(){

    	return $this->belongsTo(Category::class);
	}
	public function images(){
		return $this->hasMany(ImageManager::class);
	}
	private function checkBoolean($value){
		if ($value == true) {
			return "Yes";
		} else {
			return "No";
		}
	}
}
