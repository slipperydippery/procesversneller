<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instantie extends Model
{
    protected $fillable = [
        'scanmodel_id', 'title', 'description'
    ];

    public function scans()
    {
        return $this->hasMany(\App\Scan::class);
    }

    public function scanmodel()
    {
        return $this->belongsTo(\App\Scan::class);
    }
}
