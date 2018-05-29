<?php

namespace App\Http\Controllers;

use App\Scan;
use App\User;
use App\Group;
use App\District;
use App\Question;
use App\Instantie;
use Illuminate\Http\Request;

class AdminpagesController extends Controller
{
    public function overzichtresultaten()
    {
    	$users = User::get();
    	$scans = Scan::with('answers')->get();
    	$groups = Group::get();
    	$instanties = Instantie::get();
    	$questions = Question::with('measures')->get();
    	// $districts = District::with('scans')->get()->sortBy(function($district)
    	// {
    	//     return $district->scans->count();
    	// });
    	// $districts = District::withCount('scans')->orderBy('scans_count', 'desc')->paginate(10);
    	$districts = District::withCount('scans')
    	        ->orderBy('scans_count', 'desc')
    	        ->orderBy('title')
    	        ->paginate(50);
    	return view('admin.overzichtresultaten', compact('users', 'scans', 'groups', 'instanties', 'questions', 'districts'));

    }
}
