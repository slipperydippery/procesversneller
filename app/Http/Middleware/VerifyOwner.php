<?php

namespace App\Http\Middleware;

use Closure;
use App\Scan;
use Illuminate\Support\Facades\Auth;

class VerifyOwner
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
        $scanid = $request->route('scan')->id;
        $scan = Scan::findOrFail($scanid);
        if ($scanid != 1) {
            if (Auth::guest()) {
                return redirect()->guest('login');
            } else {
                if (Auth::user()->id != $scan->user->id) {
                    return response('Je hebt geen toegang tot deze scan', 401);
                }
            }
        }
        return $next($request);
    }
}
