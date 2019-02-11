<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'body', 'published'
    ];

    // samo ova polja ja rucno popunjavam

    // obrnuto je $guarded - sve popunjavam osim
    // protected $guarded = [
    //     'id'
    // ]

    public static function published() 
    {
        return self::where('published', 1)->orderBy('created_at', 'desc')->get();
    }

    public static function draft() 
    {
        return self::where('published', 0)->orderBy('created_at', 'desc')->get();
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }

}
