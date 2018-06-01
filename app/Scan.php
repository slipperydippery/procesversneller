<?php

namespace App;

use App\Scan;
use App\User;
use App\Group;
use App\Answer;
use App\Measure;
use App\District;
use App\Instantie;
use App\Scanmodel;
use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    protected $fillable = [
        'title', 'description', 'algemeenbeeld', 'user_id', 'group_id', 'instantie_id', 'scanmodel_id'
    ];

    public function scanmodel()
    {
        return $this->belongsTo(\App\Scanmodel::class);
    }

    public function answers()
    {
        return $this->hasMany(\App\Answer::class);
    }

    public function group()
    {
        return $this->belongsTo(\App\Group::class);
    }

    public function owns()
    {
        return $this->hasOne(\App\Group::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function grouprequest()
    {
        return $this->hasOne(\App\Grouprequest::class);
    }

    public function instantie()
    {
        return $this->belongsTo(\App\Instantie::class);
    }

    public function measures()
    {
        return $this->hasMany(\App\Measure::class);
    }

    public function districts()
    {
        return $this->belongsToMany(\App\District::class);
    }

    public function comparisonscans()
    {
        return $this->belongsToMany(\App\Scan::class, 'comparisons', 'scan_id', 'comparison_id')->withTimestamps();
    }

    public function iscomparedby()
    {
        return $this->belongsToMany(\App\Scan::class, 'comparisons', 'comparison_id', 'scan_id');
    }

    public function comparisons()
    {
        return $this->hasMany(\App\Comparison::class);
    }

    public function scandate()
    {
        return $this->hasOne(\App\Scandate::class);
    }

    public function followup()
    {
        return $this->hasOne(\App\Followup::class);
    }

    public static function registerWithGroup(User $user, Group $group, $attributes)
    {
        $scan = new Scan($attributes);
        $scan->title = $group->title;
        $user->scans()->save($scan);

        $scan->save();

        $scan->generateQuestions($scan);

        return $scan;
    }

    public static function register(User $user, $attributes)
    {
        $scan = new Scan($attributes);
        $user->scans()->save($scan);

        foreach ($attributes['districts'] as $district) {
            $district = District::find($district['id']);
            $scan->districts()->attach($district);
        }
        $scan->save();

        $scan->generateQuestions($scan);
        
        return $scan;
    }

    public function generateQuestions(Scan $scan)
    {
        foreach ($scan->scanmodel->themes as $theme) {
            foreach ($theme->questions as $question) {
                Answer::create([
                    'scan_id' => $scan->id,
                    'question_id' => $question->id
                ]);
                Measure::create([
                    'scan_id' => $scan->id,
                    'question_id' => $question->id
                ]);
            }
        }
    }
}
