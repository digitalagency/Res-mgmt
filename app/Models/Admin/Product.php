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
		'meta_title', 'meta_keywords', 'meta_description'
	];

	//Add a prefix to a price column data before displaying to a user
	public function getPriceAttribute($value){
		if(Gate::allows('product-view')){
			return 'Rs. ' . $value;
		}
		else{
			return $value;
		}
	}

	public function setSlugAttribute($value){
		$this->attributes['slug'] = str_slug($value);
	}

	/**
	 * Maping one-to-many realtionship between Category and Product
	 */
    public function category(){
    	return $this->belongsTo(Category::class);
	}

	/**
	 * Maping one-to-many relationship between Product and Images
	 */
	public function images(){
		return $this->hasMany(ImageManager::class);
	}

	/**
	 * Maping one-to-one relationship between Product and Featured Image
	 */
	public function featuredImage(){
		$imageDetails =  $this->hasOne(ImageManager::class)->where('featured', 1)->first();
		return $imageDetails;
		// $imageName = $imageDetails->getOriginal('image');
		// return $imageName;
	}

	public function scopeSingleProduct($query, $attribute, $value)
	{
		return $query->where($attribute, $value)->first();
	}


}
