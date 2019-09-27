<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [

    	'close_day', 'open_day_1', 'first_open_from', 'first_open_to', 'second_open_from', 'second_open_to', 'open_day_2', 'open_hour_2',

    ];
}
