<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
	protected $table = 'posting';
	protected $primaryKey = 'id_psoting';

    protected $fillable = [
        'judul_posting', 'tipe_posting', 'media_path', 'caption' , 'user_id' ,
    ];

    public function user(){

    	return $this->belongsTo('User', 'id');
    }

    public function like(){

        return $this->belongsToMany('User', 'likePosting', 'id_posting', 'user_id');
    }
}
