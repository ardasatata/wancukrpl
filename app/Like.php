<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likePosting';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'user_id', 'id_posting',
    ];

    public static function hasLike($user_id,$post_id){

        if (Like::where('user_id',$user_id)->where('id_posting',$post_id)->count()==1)
            return true;
        else
            return false;
    }
}
