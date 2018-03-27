@extends('Template/default')
@section('content')
    <div class="row">

        <div class="col-lg-6">
            <form action="poststatus" method="post" class="form-group {{ ($errors->has('status2')) ?'has-error':''}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <div class="form-group">
                   <textarea class="form-control" rows="2" placeholder="what 's up,{{Auth::user()->gettest()}} " name="status2" ></textarea>
               </div>
                    <button class="btn btn-primary" type="submit">Update status</button>

            </form>

        </div>

        <div class="col-lg-5"></div>

    </div>
        @if($errors->has('status2'))
            <div class="alert alert-info " id="flip">
                    {{$errors->first('status2')}}
            </div>
        @endif
    <hr>
   <div style="min-height: 500px">
       @if(count($status)>0)
           @foreach($status as $key)
               {{$key->likes}}
               <div class="media" >

                   <a class="pull-left" href="friend/{{$key->user_id}}" >
                       <img class="media-object" style="
    border-radius: 50%;
    width:  50px;
" alt="" src="{{$key->avatar}}">
                   </a>
                   <div class="media-body">
                       <h4 class="media-heading"><a href="friend/{{$key->user_id}}">{{$key->username}}</a></h4>
                       <p>{{$key->body}}</p>
                       <ul class="list-inline">
                           <li></li>
                           <li><a href="like/{{$key->id}}">Like</a></li>
                           <li>10 likes</li>
                       </ul>
                        @if($rep[$key->id])
                            @foreach($rep[$key->id] as $reply)
                               <div class="media" >
                                   <a class="pull-left" href="friend/{{$reply->user_id}}" >
                                       <img class="media-object" style="
    border-radius: 50%;
    width:  50px;
" alt="" src="{{$reply->avatar}}">
                                   </a>
                                   <div class="media-body">
                                       <h4 class="media-heading"><a href="friend/{{$reply->user_id}}">{{$reply->username}}</a></h4>
                                       <p>{{$reply->body}}</p>
                                       <ul class="list-inline">
                                           <li>2 days ago</li>
                                           <li><a href="#">Like</a></li>
                                           <li>10 likes</li>
                                       </ul>
                                   </div>
                               </div>
                           @endforeach
                       @endif
                       <form role="form" action="replypost/{{$key->id}}" method="post"  style="margin-left: 50px">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <div class="form-group {{($errors->has('reply-'.$key->id)) ?'has-error':''}}">
                               <textarea name="reply-{{$key->id}}" class="form-control" rows="2" placeholder="Reply to this status"></textarea>
                           </div>
                           <input type="submit" value="Reply" class="btn btn-default btn-sm">
                       </form>
                   </div>
               </div>
           @endforeach



       @else
           <h3>there is nothing on your post</h3>
       @endif
   </div>
    {{ $status->links() }}

@endsection