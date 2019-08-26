<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SocialMediaLinks extends Model
{
    protected $fillable = [
    	'facebook', 'instagram', 'twitter', 'linkedIn', 'google'
    ];
}
