<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scanmodel extends Model
{
    public function scans()
    {
        return $this->hasMany('App\Scan');
    }

    public function themes()
    {
        return $this->hasMany('App\Theme');
    }

    public function instanties()
    {
        return $this->hasMany('App\Instantie');
    }

    public function districts()
    {
        return $this->hasMany('App\District');
    }
}
