<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Title;
use App\Models\Rating;
use Carbon\Carbon;

class IsOldEnough
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
        $title_id = $request->route()->id;
        $title = Title::find($title_id);
        if(\Auth::guest()) {
            if($title->private) {
                \Session::flash('warning','You can\'t view that page.');
                return redirect('/');
            }
            return $next($request);
        }
        
        $user = \Auth::user();
        
        $rating = Rating::find($title->rating);
        
        $min_rating_age = Carbon::now()->subYears($rating->older_than);
        if($user->birth_date == null) {
            if($title->private) {
                \Session::flash('warning','You can\'t view that page.');
                return redirect('/');
            }
            return $next($request);
        }
        else if($user->birth_date->lte($min_rating_age)) {
            return $next($request);
        }
        else {
            \Session::flash('warning','You can\'t view that page.');
            return redirect('/');
        }
    }
}
