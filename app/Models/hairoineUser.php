<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class hairoineUser extends Authenticatable
{
    use HasFactory;

    // Define fillable properties for mass assignment
    protected $fillable = ['name', 'email', 'phone_number', 'address', 'password'];

    // Define relationships

    /**
     * Relationship with Product through Favorites (Many-to-Many)
     */
    public function favorites()
    {
        return $this->belongsToMany(
            Product::class,  // Related model
            'favorites',     // Pivot table name
            'customer_id',       // Foreign key on the pivot table that references the hairoineUser model
            'product_id'     // Foreign key on the pivot table that references the Product model
        )->withTimestamps();
    }

    /**
     * Relationship with Product through Cart (Many-to-Many with quantity)
     */
    public function cart()
    {
        return $this->belongsToMany(
            Product::class,  // Related model
            'carts',         // Pivot table name
            'customer_id',   // Foreign key on the pivot table that references the hairoineUser model
            'product_id'     // Foreign key on the pivot table that references the Product model
        )->withPivot('quantity') // Additional pivot field
          ->withTimestamps();   // Include timestamps
    }

    /**
     * Relationship with Order (One-to-Many)
     */
    public function orders()
{
    return $this->hasMany(order::class, 'customer_id');
}

}
