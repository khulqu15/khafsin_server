<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imu extends Model
{
    protected $fillable = [
        'x',
        'y',
        'z',
        'location',
        'lat',
        'lon',
        'alt',
    ]
}
