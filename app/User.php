<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_token', 'logincount'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];

    public function scans()
    {
        return $this->hasMany(\App\Scan::class);
    }

    public function groups()
    {
        return $this->hasMany(\App\Group::class);
    }

    public function dashmessages()
    {
        return $this->hasMany(\App\Dashmessage::class);
    }

    public function measures()
    {
        return $this->belongsToMany(\App\Measure::class);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
