<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    const VACANT = 0;
    const OCCUPIED = 1;
    protected $fillable = ['table_no', 'capacity', 'status'];

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
