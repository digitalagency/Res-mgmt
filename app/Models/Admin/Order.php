<?php

namespace App\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const PENDING = 'pending';
    const COOKED = 'cooked';
    const COOKING = 'cooking';

    
    
    protected $fillable = [
        'status',
        'employee_id',
        'table_id'
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order')
                    ->with('quantity')
                    ->withTimestamps();
    }
    public function customer()
    {

    }
    public function employee()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function table(){
        return $this->belongsTo(Table::class);
    }
}
