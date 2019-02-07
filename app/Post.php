<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'body'
    ];

    // samo ova polja ja rucno popunjavam

    // obrnuto je $guarded - sve popunjavam osim
    // protected $guarded = [
    //     'id'
    // ]

    public static function published() 
    {
        return self::where('published', 1)->get();
    }

    public static function draft() 
    {
        return self::where('published', 0)->get();
    }

}
