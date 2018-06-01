<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title', 'body', 'weergave_succesfactor', 'norm', 'them_id'
    ];

    public function theme()
    {
        return $this->belongsTo('App\Theme');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function measures()
    {
        return $this->hasMany('App\Measure');
    }
}
