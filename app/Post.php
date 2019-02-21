<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'body', 'published', 'user_id'
    ];

    // samo ova polja ja rucno popunjavam

    // obrnuto je $guarded - sve popunjavam osim
    // protected $guarded = [
    //     'id'
    // ]

    public static function published() 
    {
        return self::where('published', 1)->orderBy('created_at', 'desc');
    }

    public static function draft() 
    {
        return self::where('published', 0)->orderBy('created_at', 'desc')->get();
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags() 
    {
        return $this->belongsToMany(Tag::class);
    }

}
