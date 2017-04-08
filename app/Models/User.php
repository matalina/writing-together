<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    
    protected $guarded = [
        'id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    protected $casts = [
        'can_moderate' => 'boolean',
    ];
    
    public function titles()
    {
        return $this->hasMany(Title::class);
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class)
            ->with('title');
    }
    
    public function titlesUserIsIn()
    {
        $posts = $this->posts->unique('title_id');
        
        return $posts->all();   
    }
}
