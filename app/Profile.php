<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

	protected $table = 'profile';

	public $timestamps = false;

    protected $primaryKey = 'user_id';

	protected $fillable = [
        'profPic','description',
    ];

    public function user(){
    	return $this->belongsTo('User');
    }

}
