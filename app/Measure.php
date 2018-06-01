<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    protected $fillable = [
        'measure', 'active', 'scan_id', 'question_id'
    ];

    public function scan()
    {
        return $this->belongsTo(\App\Scan::class);
    }

    public function question()
    {
        return $this->belongsTo(\App\Question::class);
    }

    public function users()
    {
        return $this->belongsToMany(\App\User::class);
    }
}
