<?php

namespace App\Http\Controllers;

use App\Scan;
use App\Group;
use App\Answer;
use App\Measure;
use App\District;
use App\Question;
use App\Instantie;
use App\Scanmodel;
use App\Comparison;
use App\Dashmessage;
use App\Grouprequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScansController extends Controller
{
    /**
     * Enforce middleware.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('owner', ['except' => ['index', 'create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scans = Auth::user()->scans;
        return view('scan.index', compact('scans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instanties = Instantie::get();
        $districts = District::get();
        $groups = Group::with('owner.user')->get();
        return view('scan.create', compact('instanties', 'districts', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $scan = Scan::register($user, $request->all());

        $grouprequest =  false;

        if ($request->has('group_bool')) {
            $group = Group::findOrFail($request->group_id);
            $grouprequest = $group;
            //  send a message to group owner
            Grouprequest::create([
                'group_id' => $request->group_id,
                'scan_id' => $scan->id,
            ]);
        }

        return view('scan.postcreate', compact('scan', 'grouprequest'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Scan $scan)
    {
        if ($scan->algemeenbeeld) {
            $answercount = 0;
            $questioncount = 0;
            foreach ($scan->answers as $answer) {
                if ($answer->answer) {
                    $answercount++;
                }
                $questioncount++;
            }
            if ($answercount == $questioncount) {
                return redirect()->route('scan.complete', compact('scan'));
            }
        }
        return redirect()->route('scan.startscan', compact('scan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idate()
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scan $scan)
    {
        $scan->comparisonscans()->delete();
        $scan->comparisons()->delete();
        $scan->districts()->detach();
        $scan->delete();
        return redirect()->route('home');
    }

    public function selfdestruct(Scan $scan)
    {
        // foreach($scan->comparisonscans as $comparescan) {
        //     $comparescan->comparisons()->delete();
        // }
        Comparison::where('comparison_id', $scan->id)->delete();
        Comparison::where('scan_id', $scan->id)->delete();
        // foreach($scan->iscomparedby->where('scan_id', $scan->id) as $comparescan) {
        //     return 'iscomparedby';
        //     $comparescan->comparisons()->delete();
        // }
        // foreach($scan->comparisons as $comparison){
        //     $comparison->delete();
        // }
        // $scan->comparisons()->delete();
        $scan->districts()->detach();
        $scan->delete();
        return redirect()->route('home');
    }
}
