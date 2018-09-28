<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function scopeIncompete($query)

    {
      return $query->where('completed', 0);
    }
}
