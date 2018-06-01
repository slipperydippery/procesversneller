<?php

namespace App\Http\Controllers;

use App\User;
use App\Dashmessage;
use Illuminate\Http\Request;

class ApiDashmessagesController extends Controller
{
    public function index(User $user)
    {
        return $user->dashmessages;
    }

    public function delete(Dashmessage $dashmessage)
    {
        $dashmessage->delete();
        return ('deleted');
    }
}
