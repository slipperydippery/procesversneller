<?php

namespace App\Http\Controllers;

use App\Scan;
use App\User;
use App\Group;
use App\Theme;
use App\Scanmodel;
use App\Grouprequest;
use Illuminate\Http\Request;
use App\Events\DashmessageUpdate;
use App\Events\GrouprequestCreated;
use App\Jobs\SendGrouprequestEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ApiScansController extends Controller
{
    /**
     * Enforce middleware.
     */
    public function __construct()
    {
        // $this->middleware('owner', ['except' => ['index', 'create', 'store']]);
    }
    
    public function index()
    {
        return Scan::with('user', 'answers', 'instantie', 'districts')->get();
    }

    public function indexuser(User $user)
    {
        return Scan::with('comparisons.compared.user', 'comparisons.compared.answers', 'comparisons.compared.instantie', 'comparisons.compared.districts', 'group.scans')->where('user_id', $user->id)->get();
    }

	public function show(Scan $scan)
	{
        return Scan::with('answers', 'user', 'instantie', 'measures', 'districts')->findOrFail($scan->id);
	}

    public function store(Request $request)
    {        
        if($request->isgroup) {
            request()->validate([
                'isgroup' => 'required|boolean',
                'selectedgroup' => 'required|integer',
                'instantie_id' => 'required|integer',
            ]);
        } else {
            request()->validate([
                'isgroup' => 'required|boolean',
                'title' => 'required|min:3|max:255',
                'instantie_id' => 'required|integer',
                'districts' => 'required'
            ]);
        }

        $user = Auth::user();

        if($request->isgroup) {
            $group = Group::find($request->selectedgroup);
            $scan = Scan::registerWithGroup($user, $group, $request->all());
        } else {
            $scan = Scan::register($user, $request->all());
        }

        // $grouprequest =  false;
        if($request->isgroup) {
            // $grouprequest = $group;
            $grouprequest = Grouprequest::create([
                'group_id' => $group->id,
                'scan_id' => $scan->id,
            ]);
            $owner = $group->owner->user;
            GrouprequestCreated::dispatch($grouprequest, $group->owner->user->id);
            dispatch(new SendGrouprequestEmail($user, $group, $owner));
        }
        return $scan;
    }

	public function update(Request $request)
	{
		$scan = Scan::findOrFail($request->scan['id']);
		$scan->title = $request->scan['title'];
		$scan->description = $request->scan['description'];
        $scan->algemeenbeeld = $request->scan['algemeenbeeld'];
		$scan->group_id = $request->scan['group_id'];
		$scan->save();
		return $request;
	}

    public function indexthemes(Scan $scan)
    {
    	return $scan->scanmodel->themes->with('questions')->get();
    }

    public function indexquestions(Scan $scan, Theme $theme)
    {
    	return $theme->questions;
    }

    public function indexanswers(Scan $scan)
    {
    	return $scan->answers;
    }

    public function storewithanswers(Request $request, Scan $scan)
    {
    	// foreach($request->body as $answer){
    	// 	return $answer;
    	// }
    	return $request->body->answers;
    	return $request->body;
    }

    public function postanswer(Request $request, Scan $scan)
    {
    	return $request;
    }

    public function getuser(Scan $scan)
    {
    	return $scan->user->get();
    }

    public function getdistricts(Scan $scan)
    {
        return $scan->districts;
    }

    public function updatedistricts(Scan $scan, Request $request)
    {
        $scan->districts()->sync($request['districts']);
    }

}
