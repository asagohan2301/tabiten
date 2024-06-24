<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['latitude', 'longitude'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
