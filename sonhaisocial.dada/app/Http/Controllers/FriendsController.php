<?php

namespace App\Http\Controllers;
use App\User;
use App\Friends;
use Illuminate\Http\Request;
use Auth;

class FriendsController extends Controller
{
    public function getfriend($id){
        $user = User::find($id);
        $friend = $user->friend();
        return view('friend/getfriend',['user'=> $user,'friend'=>$friend]);
    }
    public function getadd($id){
        $addfr = new Friends();
        $addfr->user_id = Auth::user()->id;
        $addfr->friend_id = $id;
        $addfr->save();
        return redirect()->route('friend', ['id' => $id]);
    }
    public function getaccept($id){
        $fr = Friends::where('user_id',$id)->where('friend_id',Auth::user()->id)->first();
        $fr->accepted = 1;
        $fr->save();
    return redirect()->route('friend', ['id' => $id]);
    }

}
