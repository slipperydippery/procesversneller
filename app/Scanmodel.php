<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scanmodel extends Model
{
    public function scans()
    {
        return $this->hasMany(\App\Scan::class);
    }

    public function themes()
    {
        return $this->hasMany(\App\Theme::class);
    }

    public function instanties()
    {
        return $this->hasMany(\App\Instantie::class);
    }

    public function districts()
    {
        return $this->hasMany(\App\District::class);
    }
}
