<?php

namespace App\Http\Controllers;

use App\Scan;
use App\Compare;
use Illuminate\Http\Request;

class ApiComparesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $scan = Scan::find($request->scan['id']);
        $compare = Scan::find($request->compare['id']);
        $scan->compares()->save($compare);
        return $request->all();
    }

    public function destroycompare(Scan $compare, Scan $scan)
    {
        $scan->compares()->detach($compare);
    }
}
