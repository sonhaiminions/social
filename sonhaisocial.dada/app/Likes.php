<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $table = 'likes';
    protected $fillable = ['user_id','status_id'];

//    protected $primaryKey = ['user_id', 'status_id'];
}
