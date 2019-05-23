<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

    protected $table = 'userFollowing';

    protected $fillable = [
        'user_id' , 'followed_id'
    ];

    public $timestamps = false;

    public static function isFollowing($user_id,$followed_id){
        if (Follow::where('user_id',$user_id)->where('followed_id',$followed_id)->count()>=1)
            return true;
        else
            return false;
    }

    public function posting(){

        return $this->belongsToMany('App\Posting','userFollowing','followed_id', 'user_id');
    }
}
