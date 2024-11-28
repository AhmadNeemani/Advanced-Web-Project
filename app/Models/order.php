<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'product_id', 'total', 'time'];

    // Relationship with HairoineUser (Many-to-One)
    public function customer()
    {
        return $this->belongsTo(HairoineUser::class, 'customer_id');
    }

    // Relationship with Product (Many-to-One)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relationship with Payment (One-to-Many)
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
