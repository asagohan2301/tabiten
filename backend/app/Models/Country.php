<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
