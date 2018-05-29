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
    	return $this->belongsTo('App\Scan');
    }

    public function question()
    {
    	return $this->belongsTo('App\Question');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
