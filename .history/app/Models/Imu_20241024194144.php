<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imu extends Model
{
    protected $table = 'imus';
    protected $primaryKey = 'id';

    protected $fillable = [
        'x',
        'y',
        'z',
        'location',
        'status',
        'description',
        'lat',
        'lon',
        'alt',
    ];
}
