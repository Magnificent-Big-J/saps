<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Report extends Model
{
    protected $guarded = ['id'];
    protected $hidden = [
         'updated_at',
    ];
    public function circulations()
    {
        return $this->belongsTo(Circulation::class);
    }
    public function getCreatedAtAttribute($value)
    {
        $value = new Carbon($value);
        return $value->toFormattedDateString();
    }


}
