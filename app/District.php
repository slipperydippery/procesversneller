<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'scanmodel_id', 'title'
    ];

    public function scanmodel()
    {
        return $this->belongsTo('App\Scanmodel');
    }

    public function scans()
    {
        return $this->belongsToMany('App\Scan');
    }
}
