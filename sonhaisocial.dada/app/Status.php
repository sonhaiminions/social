<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $fillable = ['user_id',
        'body'];
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    public function likes()
    {
        return $this->morphMany('App\Likes', 'likeable');
    }


}
