<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'food_orders')->withPivot('quantity');
    }

    public function orderAddOns()
    {
        return $this->belongsToMany(AddOns::class, 'order_add_ons')
            ->withPivot('quantity'); // Include additional pivot table columns like quantity
    }
}
