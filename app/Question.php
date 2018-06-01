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
        return $this->belongsTo(\App\Theme::class);
    }

    public function answers()
    {
        return $this->hasMany(\App\Answer::class);
    }

    public function measures()
    {
        return $this->hasMany(\App\Measure::class);
    }
}
