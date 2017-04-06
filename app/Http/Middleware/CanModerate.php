<?php

namespace App\Http\Middleware;

use Closure;

class CanModerate
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
        $user = \Auth::user(); 
        
        if($user->can_moderate === true) {
            return $next($request);
        }
        \Session::flash('warning','You do not have permission to do that action.');
        return redirect()->back();
        
    }
}
