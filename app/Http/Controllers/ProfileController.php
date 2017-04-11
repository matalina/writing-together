<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\SaveProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $users = User::all();    
        
        return view('users')
            ->with('users',$users);
    }
    
    public function view($id = null) 
    {
        if($id == null) {
            $user = \Auth::user();
        }
        else {
            $user = User::find((int) $id);
        }
        
        return view('profile')
            ->with('user',$user);
    }
    
    public function update()
    {
        $user = \Auth::user();
        
        return view('editProfile')
            ->with('user',$user);
    }
    
    public function save(SaveProfileRequest $request)
    {
        $user = \Auth::user();
        
        $data = [
            'name' => $request->get('name'),
            'birth_date' => $request->get('birthdate'),
            'email' => $request->get('email'),
            'timezone' => $request->get('timezone'),
        ];
        
        if($request->has('can_moderate')) {
            $data['can_moderate'] = $request->get('can_moderate');
        }
        
        $user->update($data);
        
        return redirect()->route('profile.view');
    }
    
    public function setModerator($id)
    {
        $user = User::find((int) $id);
        
        $user->can_moderate = true;
        $user->save();
        
        \Session::flash('success','Moderator sucessfully set.');
        return redirect()->back();
    }
}
