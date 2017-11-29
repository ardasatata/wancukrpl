<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Posting extends Model
{
	protected $table = 'posting';
	protected $primaryKey = 'id_posting';

    protected $fillable = [
        'judul_posting', 'tipe_posting', 'media_path', 'caption' , 'user_id' ,
    ];

    public static function myPost($user_id,$post_id){
        if (Posting::where('user_id',$user_id)->where('id_posting',$post_id)->count()==1)
            return true;
        else
            return false;
    }

    public function user(){

    	return $this->belongsTo('User', 'id');
    }

    public function like(){

        return $this->belongsToMany('App\User', 'likePosting', 'id_posting', 'user_id');
    }

    public function followed(){

        return $this->belongsToMany('App\Follow', 'userFollowing','followed_id','user_id');
    }


}
