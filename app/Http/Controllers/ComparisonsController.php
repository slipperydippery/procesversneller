<?php

namespace App\Http\Controllers;

use App\District;
use App\Instantie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComparisonsController extends Controller
{
    /**
     * Enforce middleware.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$user = Auth::user();
    	$districts = District::get();
    	$instanties = Instantie::get();
    	return view ('compare.comparescans', compact('user', 'districts', 'instanties'));
    }
}
