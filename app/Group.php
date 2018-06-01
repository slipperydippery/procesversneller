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
        return $this->hasMany(\App\Scan::class);
    }

    public function owner()
    {
        return $this->belongsTo(\App\Scan::class, 'scan_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function grouprequests()
    {
        return $this->hasMany(\App\Grouprequest::class);
    }
}
