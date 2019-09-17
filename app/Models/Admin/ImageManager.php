<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ImageManager extends Model
{
    protected $guarded  = [];

    /**
     * One-to-Many relationship wiht Product entity
     */
    public function product(){
        return $this->belongsTo(Product::class);
    }

    /**
     * Prefix the image name with the file path
     * 
     * @param string $value
     */
    public function getImageAttribute($value)
    {
        $imagePath = asset('uploads/products/'.$value);
        return $imagePath;
    }

    public function scopeImageFind($query, $attribute, $value)
    {
        return $query->where($attribute, $value);
    }

}
