<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $primaryKey = 'id_comment';

    protected $fillable = [
        'user_id', 'id_posting', 'comment',
    ];

    public static function myComment($user_id,$post_id){
        if (Comment::where('user_id',$user_id)->where('id_posting',$post_id)->count()>=1)
            return true;
        else
            return false;
    }
}
