<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'title', 'scan_id', 'user_id', 'code'
    ];

    public function scans()
    {
        return $this->hasMany('App\Scan');
    }

    public function owner()
    {
        return $this->belongsTo('App\Scan', 'scan_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function grouprequests()
    {
        return $this->hasMany('App\Grouprequest');
    }
}
