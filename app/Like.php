<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likePosting';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'id_posting',
    ];
}
