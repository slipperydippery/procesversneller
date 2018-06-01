<?php

namespace App\Http\Controllers;

use App\Scan;
use App\Group;
use App\District;
use App\Dashmessage;
use App\Grouprequest;
use Illuminate\Http\Request;
use App\Events\DashmessageUpdate;
use App\Jobs\SendGroupdeniedEmail;
use App\Jobs\SendGrouprequestEmail;
use App\Jobs\SendGroupacceptedEmail;

class ApiGrouprequestsController extends Controller
{

    public function index(Group $group)
    {
        $grouprequests = Grouprequest::with('scan.user', 'scan.instantie', 'group')->where('group_id', $group->id)->get();
        return $grouprequests;
    }

    public function accept(Grouprequest $grouprequest)
    {

        $scan = Scan::findOrFail($grouprequest->scan_id);
        $group = Group::findOrFail($grouprequest->group_id);
        $group->scans()->save($scan);
        $grouprequest->delete();
        $user_id = $scan->user->id;

        $dashmessage = Dashmessage::create([
            'message' => 'Je aanvraag om mee te doen aan de groep <i>' . $group->title . '</i> geaccepteerd!.',
            'user_id' =>  $user_id,
        ]);
        DashmessageUpdate::dispatch($dashmessage, $user_id);

        dispatch(new SendGroupacceptedEmail($scan->user, $group));

        return 'accepted';
    }

    public function deny(Grouprequest $grouprequest)
    {
        $scan = Scan::findOrFail($grouprequest->scan_id);
        $group = Group::findOrFail($grouprequest->group_id);
        $user_id = $scan->user->id;
        $dashmessage = Dashmessage::create([
            'message' => 'Helaas is je aanvraag om mee te doen aan de groep <i>' . $group->title . '</i> geweigerd.',
            'user_id' =>  $user_id,
        ]);
        DashmessageUpdate::dispatch($dashmessage, $user_id);

        $user = $scan->user;

        dispatch(new SendGroupdeniedEmail($user, $group));
        $grouprequest->delete();

        return 'denied';
    }
}
