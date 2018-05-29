<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiUsersController extends Controller
{
    /**
     * Enforce middleware.
     */
    public function __construct()
    {
        $this->middleware('user');
    }

    public function nomorehints(User $user)
    {
    	$user->hints = false;
    	$user->save();
    	return $user;
    }

    public function turnonhints(User $user)
    {
    	$user->hints = true;
    	$user->save();
    	return $user;
    }
}
