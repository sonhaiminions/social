<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Status;
use App\User;
use App\Likes;
use Auth;
use Illuminate\Support\Facades\DB;
class StatusController extends Controller
{
    public function getlist($id){
        $man = User::find($id);
        $list=$man->friend();
        $a[] = $man->id;
        if($list)
        {
            foreach($list as $key ) {
                $a[]= $key->id;
            }
        }
        return $a;

    }
    public function index(){
//        $current =new Carbon('2018-03-26 13:49:45');
//        $current =Carbon::parse('2018-03-26 13:49:45')->diffForHumans();
//        $current;
//        dd($current);
       $a = $this->getlist(Auth::user()->id);

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
        return view('Timeline/index',['status'=>$status,'rep'=>$rep]);
    }
    public function poststatus(Request $request){
        $this->validate($request,
            [
                'status2' => 'required|min:4|max:100',
            ],
            [
                'status2.required' => 'u dont enter status',
                'status2.max' => 'status too long',
                'status2.min' => 'status too short',
            ]);
        $status = new Status();
        $status->user_id = Auth::user()->id;
//        $status->parent_id = Auth::user()->id;
        $status->body = $request->status2;
        $status->save();
        return redirect()->route('timeline');
    }
    public function replypost(Request $request,$id){
        $this->validate($request,
            [
                'reply-'.$id => 'required|min:4|max:100',
            ]
        ,
            [
                'reply-'.$id.'required'=>'body is not null'
            ]);
        $status = new Status();
        $status->user_id = Auth::user()->id;
        $status->parent_id = $id;
        $status->body = $request->input('reply-'.$id);
        $status->save();
return redirect()->route('timeline');
    }
    public function like($id){
        $like = new Likes();
        $like->user_id = Auth::user()->id;
        $like->status_id = $id;
        $like->save();
        return redirect()->back();
    }
}
