<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;

class Post extends Model
{
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function title()
    {
        return $this->belongsTo(Title::class);
    }
    
    public function getBodyAttribute($value)
    {
        $converter = new CommonMarkConverter();
        return $converter->convertToHtml($value);
    }
}
