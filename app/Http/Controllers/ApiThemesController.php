<?php

namespace App\Http\Controllers;

use App\Scanmodel;
use Illuminate\Http\Request;

class ApiThemesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Scanmodel::find(1)->themes;
    }
}
