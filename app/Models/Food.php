<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'rating', 'mage'];

    protected $with = ['category'];

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas('category', fn ($query) =>
            $query->where('id', $category))
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'food_orders')->withPivot('quantity');
    }
}
