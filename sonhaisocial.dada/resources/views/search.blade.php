@extends('Template/default')
@section('content')

@if(isset($result))
@if($key)
<h3>Your search for key {{$key}}</h3>
@endif
		@foreach($result as $user)
		<div class="row">
			<div class="col-lg-3 media">

				<a class="pull-left" href="friend/{{$user->id}}">
					<img class="media-object img-circle" alt="" src="{{$user->avatar}}">
				</a>
				<div class="media-body">
					<h4 class="media-heading"><a href="friend/{{$user->id}}">{{$user->username}}</a></h4>
					{{$user->location}}
				</div>
			</div>
			<div class="col-lg-3 ">
				@if(Auth::user()->isfriendwith($user))
					{{$user->username}} is friend with U
				@elseif(Auth::user()->hasfriendrequestpending($user))
				waiting for {{$user->username}} accept your friend request !
				@elseif(Auth::user()->hasfriendrequestreceive($user))
				<p class="btn bnt-primary"> accept friend</p>
				@else
				<a href="getadd/{{$user->id}}"><p class="btn btn-primary"> add friend</p></a>
				@endif
			</div>
		</div>
		@endforeach
@else
	<div class="media">

			<a class="pull-left" href="">
				<img class="media-object" alt="" src="">
			</a>
			<div class="media-body">
				<h4 class="media-heading">{{$result2}}</h4>
			</div>
		</div>
@endif


@endsection