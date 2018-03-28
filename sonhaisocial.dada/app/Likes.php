<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $table = 'likes';
    protected $fillable = ['user_id','likeable_id','likeable_type'];
    public function likeable()
    {
        return $this->morphTo();
    }
//    protected $primaryKey = ['user_id', 'status_id'];
}
