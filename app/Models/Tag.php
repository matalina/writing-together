<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = ['id'];
    
    public function titles() 
    {
        return $this->belongsToMany(Title::class,'tags_titles');
    }
}
