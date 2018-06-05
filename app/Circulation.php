<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circulation extends Model
{
    protected $guarded = [];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    public function reports()
    {
       return $this->hasMany(Report::class);
    }
}
