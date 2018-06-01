<?php

namespace App\Http\Middleware;

use Closure;
use App\Group;
use Illuminate\Support\Facades\Auth;

class VerifyGroupOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $groupid = $request->route('group')->id;
        $group = Group::findOrFail($groupid);
        if (Auth::guest()) {
            return redirect()->guest('login');
        } else {
            if (Auth::user()->id != $group->user->id) {
                return response('Je hebt geen toegang tot deze group', 401);
            }
        }
            
        return $next($request);
    }
}
