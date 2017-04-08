<?php
use Carbon\Carbon;

function timezoneList()
{
    $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
    
    return $tzlist;
}

function printDate(Carbon $date, $diff = false)
{
    if(\Auth::check()) {
        $user = \Auth::user();
        
        if(!empty($user->timezone)) {
            $timezones = timezoneList();
            $date->timezone = $timezones[$user->timezone];
        }
    }
    
    if($diff) {
        return $date->diffForHumans();
    }
    else {
        return $date->format('M j,Y \a\t g:i A');
    }
}