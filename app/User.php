<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function userName($user_id){
        return User::find($user_id)->name;
    }

    public static function isAdmin(){

        $user = User::find(Auth::id());

        if ($user->admin==true)
            return true;
        else
            return false;
    }

    public function profile(){

        return $this->hasOne('Profile','user_id');
    }

    public function posting(){

        return $this->hasMany('Posting','id_posting');
    }

    public function like(){

        return $this->belongsToMany('Posting', 'likePosting', 'user_id', 'id_posting');
    }

    public function following(){

        return $this->belongsToMany('User', 'userFollowing', 'user_id', 'followed_id');
    }
}
