<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $guarded = ['id'];
    
    protected $dates = ['created_at','updated_at'];
    
    public function titles()
    {
        return $this->hasMany(Title::class);
    }
    
}
