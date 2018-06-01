<?php

namespace App\Http\Controllers;

use App\Scan;
use App\District;
use App\Instantie;
use App\Scanmodel;
use App\Thememodel;
use App\Questionmodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function welcome()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('welcome');
    }

    public function startscan()
    {
        if (Auth::check()) {
            return redirect()->route('scan.index');
        }
        // Page with: log in / register
        //               trial scan
        return view('pages.startscan');
    }

    public function instructiefilms()
    {
        return view('pages.instructiefilms');
    }

    public function kennisbank()
    {
        return view('pages.kennisbank');
    }

    public function pmonitor()
    {
        return view('pages.pmonitor');
    }

    public function grouprequested()
    {
        return view('pages.grouprequested');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function partijen()
    {
        return view('pages.partijen');
    }
}
