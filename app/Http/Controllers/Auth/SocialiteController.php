<?php namespace App\Controllers\Auth;

use \Auth;
use \Socialite;
use \Session;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        
        Session::flash('succes','Successfully logged in');
        return redirect()->back();
    }
    
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        
        if ($authUser) {
            return $authUser;
        }
        
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }
    
    public function logout()
    {
        Auth::logout();
        
        Session::flash('success','Sucesfully logged out!');
        return redirect('/');
    }
}