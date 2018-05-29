<?php

namespace App\Http\Controllers;

use App\Scan;
use App\Group;
use App\Measure;
use App\District;
use App\Postcode;
use App\Scanmodel;
use App\Instantie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller
{
    /**
     * Enforce middleware.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('groupowner', ['except' => ['create', 'createscan', 'store']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::get();
        $instanties = Instantie::get();
        return view('group.create', compact('districts', 'instanties'));
    }

    public function createscan(Group $group, $code)
    {
        if($code == $group->code) {
            $instanties = Instantie::get();
            return view('group.createscan', compact('group', 'instanties'));
        } 
        return view('welcome');
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
        $group = new Group([
            'title' => $request->title,
            'user_id' => $user->id,
            'scan_id' => $scan->id,
            'scanmodel_id' => $request->scanmodel_id,
        ]);
        $group->save();
        $group->scans()->save($scan);
 
        foreach($request['districts'] as $district) {
            $district = District::find($district['id']);
            $group->districts()->attach($district);
        }

        $scanmodel = Scanmodel::findOrFail(1);
        foreach($scanmodel->themes as $theme) {
            foreach($theme->questions as $question) {
                Measure::create([
                    'group_id' => $group->id,
                    'question_id' => $question->id
                ]);
            }
        }

        $group->save();
        
        return redirect()->route('home');
    }

    public function created(Group $group)
    {
        return view('group.created', compact('group'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $group = Group::with('scans.user')->findOrFail($group->id);
        $districts = District::all();
        return view('group.show', compact('group', 'districts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {

        $group->owner->districts()->detach();
        $group->delete();
        return redirect()->route('home');
    }
}
