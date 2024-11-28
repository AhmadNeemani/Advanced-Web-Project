<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class favorite extends Pivot
{
    protected $table = 'favorites';
}
