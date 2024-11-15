<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category_id', 'quantity'];

    // Relationship with Category (Many-to-One)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with HairoineUser through Favorites (Many-to-Many)
    public function favoritedBy()
    {
        return $this->belongsToMany(HairoineUser::class, 'favorites')->withTimestamps();
    }

    // Relationship with HairoineUser through Cart (Many-to-Many with quantity)
    public function inCartOf()
    {
        return $this->belongsToMany(HairoineUser::class, 'carts')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    // Relationship with Order (One-to-Many)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
