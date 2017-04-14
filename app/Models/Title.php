<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        return $this->belongsToMany(Tag::class, 'tags_titles');
    }
    
    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }
    
    public function getLastPost()
    {
    
        $post = $this->posts->sortByDesc('created_at')->first();
        
        return $post;
    }
    
    public function scopeVisible($query)
    {
        if(\Auth::guest()) {
            // return only Everyone Rating & public threads
            return $query->where('rating','=',1)
                ->where('private','=',0);
        }
        
        return $query;
    }
}
