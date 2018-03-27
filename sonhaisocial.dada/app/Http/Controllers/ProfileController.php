<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller {
	public function getprofile($id) {
        $user = User::find($id);
        $list=$user->friend();
        $a[] = $id;
        $status = DB::table('status')->join('users', 'status.user_id', '=', 'users.id')
            ->select('status.*','users.username', 'users.avatar', 'users.location')
            ->whereIn('user_id', $a)->orderBy('created_at','desc')->where('status.parent_id',0)
            ->paginate(2);
        $rep='';
        for ($i = 0;$i < count($status);$i++){
            $rep[$status[$i]->id] = DB::table('status')->join('users', 'status.user_id', '=', 'users.id')
                ->select('status.*','users.username', 'users.avatar', 'users.location')
                ->whereIn('user_id', $a)->orderBy('created_at','asc')->where('status.parent_id',$status[$i]->id)->get();
        }
		$user = User::find($id);
		$friend = $user->friend();
        $request = $user->friendrequest();

		return view('profile/profile', ['user' => $user, 'friend' => $friend,'request'=> $request,'status'=>$status,'rep'=>$rep]);
	}
	public function geteditprofile($id) {
		$user = User::find($id);
		return view('profile/editprofile', ['user' => $user]);
	}
	public function posteditprofile($id, Request $request) {
		$user = User::find($id);
		$this->validate($request,
			[
				'firstname' => 'min:4|max:100',
				'lastname' => 'min:4|max:100',
				'location' => 'min:4|max:100',
			]);
		$user->firstname = $request->firstname;
		$user->lastname = $request->lastname;
		$user->location = $request->location;
		$user->save();
		return redirect()->route('home')->with('info', 'you update info successfull ! ');
	}
}
