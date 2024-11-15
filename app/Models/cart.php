<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class cart extends Pivot
{
    protected $table = 'carts';
    protected $fillable = ['quantity'];
}
