<?php

namespace App;
use App\Status;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
class User extends Authenticatable {
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	public function gettest() {
		if ($this->firstname && $this->lastname) {
			return $this->firstname . ' ' . $this->lastname;
		}
		return $this->username;
	}
	public function getid() {
		return $this->id;
	}
	public function friendofmine() {
		return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id')->wherePivot('accepted', 1)->get();
	}
	public function friendof() {
		return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id')->wherePivot('accepted', 1)->get();
	}
	public function friend() {
		$a = $this->friendofmine();
		$b = $this->friendof();
        $c =$a-> merge($b);
		return $c;
	}
	//lay danh sach gui yeu cau ket ban voi ban
    public function friendrequest() {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id')->wherePivot('accepted', 0)->get();
    }
    // danh sach ban gui yckb chua dc accept
    public function friendrequestpending(){
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id')->wherePivot('accepted', 0)->get();
    }
    // kiem tra yeu cau ket ban  $user voi ban
    public function hasfriendrequestreceive(User $user){
            return $this->friendrequest()->where('id',$user->id)->count();
    }
    //// kiem tra yeu cau ket ban voi $user
    public function hasfriendrequestpending(User $user){
        return $this->friendrequestpending()->where('id',$user->id)->count();
    }
    //check xem co phai la ban be voi $user
    public function isfriendwith(User $user){
        return $this->friend()->where('id',$user->id)->count();
    }
    public function statuses(){
       return $this->hasMany('App\Status','user_id','id');
    }

    public function hasliked($id){
        $status = Status::find($id);
        return $status->likes()->where('user_id',$this->id)->where('likeable_id',$id)->count();
    }




}
