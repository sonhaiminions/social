
@extends('Template/default')
@section('content')


    <div class="row">
        <div class="col-lg-6">
            <h3>{{$user->username}}'s info </h3>

                <div class="media">

                    <a class="pull-left" href="friend/{{$user->id}}">
                        <img class="media-object img-circle" alt="" src="{{$user->avatar}}">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="friend/{{$user->id}}">{{$user->username}}</a></h4>
                        {{$user->location}}
                    </div>
                </div>

        </div>
        <div class="col-lg-6">
            <div >
                    <div>
                        @if(Auth::user()->isfriendwith($user))
                            {{$user->username}} is friend with U
                        @elseif(Auth::user()->hasfriendrequestpending($user))
                            waiting for {{$user->username}} accept your friend request !
                        @elseif(Auth::user()->hasfriendrequestreceive($user))
                            <p class="btn bnt-primary"> accept friend</p>
                        @else
                            <p>U and <span class="alert-info">{{$user->username}}</span> is not friend,let add friend to more funny</p>
                            <p class="btn btn-primary"> add friend</p>
                        @endif
                    </div>
                <h3>{{$user->username}}'s friends </h3>
                @if(count($friend)==0)
                    {{$user->username}} has no friend
                @endif
                @foreach($friend as $key)
                    <div class="media">

                        <a class="pull-left" href="friend/{{$key->id}}">
                            <img class="media-object img-circle" alt="" src="{{$key->avatar}}">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="friend/{{$key->id}}">{{$key->username}}</a></h4>
                            {{$key->location}}
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection