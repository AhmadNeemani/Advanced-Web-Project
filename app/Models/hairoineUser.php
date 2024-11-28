<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class hairoineUser extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone_number', 'address', 'password'];

    // Relationship with Product through Favorites (Many-to-Many)
    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites')->withTimestamps();
    }

    // Relationship with Product through Cart (Many-to-Many with quantity)
    public function cart()
    {
        return $this->belongsToMany(Product::class, 'carts')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    // Relationship with Order (One-to-Many)
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}

