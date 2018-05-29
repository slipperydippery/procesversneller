<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comparison extends Model
{
	protected $fillable = [
		'scan_id', 'comparison_id'
	];

	// parentscan
    public function comparer()
    {
    	return $this->belongsTo('\App\Scan', 'scan_id');
    }

    public function compared()
    {
    	return $this->belongsTo('App\Scan', 'comparison_id');
    }
}
