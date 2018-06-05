<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = ['vin_number','engine_number','number_plate','license_disc_number_plate'];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

}
