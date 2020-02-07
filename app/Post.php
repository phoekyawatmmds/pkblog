<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    protected $fillable = [
        "title",
        "content",
        "is_pulish",
        "author_id"
    ];


    public function author()
    {
       return $this->belongsTo(User::class,'author_id');
    }


    public function getExcerptAttribute()
    {
      
       $text = implode(" ",collect(explode(" ",$this->content))->take(20)->toArray())." ....";
       return $text;
       
    }

    public function scopePublished($query)
    {
        return $query->where('is_pulish',true);
    }

    public function scopeAuthor($query,$login_user_id)
    {
        return $query->where('author_id',$login_user_id);
    }
}

