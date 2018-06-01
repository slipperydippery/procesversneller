<?php

namespace App\Http\Controllers;

use App\Scan;
use App\User;
use App\Group;
use App\Measure;
use App\District;
use App\Scanmodel;
use App\Districtmodel;
use Illuminate\Http\Request;
use App\Events\GroupscoresUpdated;
use App\Events\GrouprequestCreated;
use App\Jobs\SendGroupremovedEmail;
use Illuminate\Support\Facades\Auth;

class ApiGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return $user->groups;
    }

    public function indexusers(Group $group)
    {
        $users = [];
        foreach ($group->scans as $scan) {
            array_push($users, $scan->user);
        }
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required|min:3|max:255',
            'instantie_id' => 'required|integer',
            'districts' => 'required'
        ]);

        $user = Auth::user();
        $scan = Scan::register($user, $request->all());

        $code = str_random(10);
        $group = new Group([
            'title' => $request->title,
            'code' => $code,
            'user_id' => $user->id,
            'scan_id' => $scan->id,
            'scanmodel_id' => $scan->scanmodel->id,
        ]);
        $group->save();
        $group->scans()->save($scan);

        return $group;
    }

    public function storescan(Group $group, Request $request)
    {
        request()->validate([
            'instantie_id' => 'required|integer',
        ]);

        $user = Auth::user();

        $scan = Scan::registerWithGroup($user, $group, $request->all());

        $group->scans()->save($scan);
        
        return $scan;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return Group::with('scans.user', 'scans.answers', 'scans.instantie', 'owner.measures.users')->where('id', $group->id)->get()->first();
    }

    public function updatedistricts(Group $group, Request $request)
    {
        $group->districts()->sync($request['districts']);
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
    public function update(Request $request, Group $group)
    {
        $group->title = $request->group['title'];
        $group->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function removescan(Group $group, Scan $scan)
    {
        // $scan->group()->dissociate();
        // $scan->save();

        $user = $scan->user;
        $owner = $group->user;

        dispatch(new SendGroupremovedEmail($user, $group, $owner));

        return $group;
    }

    public function broadcastupdate(Group $group)
    {
        GroupscoresUpdated::dispatch($group->id);
        return $group->id;
    }
}
