<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scandate extends Model
{
    protected $fillable = [
        'date', 'date_readable', 'scan_id'
    ];

    public function scan()
    {
        $this->belongsTo('App\Scan');
    }
}
