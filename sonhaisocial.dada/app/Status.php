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

    public function diff(){
        $current =Carbon::parse('2018-03-26 13:49:45')->diffForHumans();
//        $current;
//        dd($current);
        return  $this->$current;
    }
    public function likes(){
        return $this->morphMany('App\Likes','status_id');
    }
}
