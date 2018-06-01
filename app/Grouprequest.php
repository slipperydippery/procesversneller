<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grouprequest extends Model
{
    protected $fillable = [
        'scan_id', 'group_id'
    ];

    public function scan()
    {
        return $this->belongsTo('App\Scan');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
