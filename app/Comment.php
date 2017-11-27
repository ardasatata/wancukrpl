<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $table = 'comment';
    protected $primaryKey = 'id_comment';

    protected $fillable = [
        'user_id', 'id_posting', 'comment',
    ];

    public static function myComment($user_id){
        if ($user_id==Auth::id())
            return true;
        else
            return false;
    }
}
