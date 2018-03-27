<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model {
	protected $table = 'friends';
	protected $fillable = ['user_id', 'friend_id', 'accepted'];
}
