<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $guarded = ['id'];
    
    protected $dates = ['created_at','updated_at','last_post'];
    
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
