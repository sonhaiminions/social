@extends('Template/default')
@section('content')


<div class="row">
    <div class="col-lg-5">
        	<div class="media">

			<a class="pull-left" href="getprofile">
				<img class="media-object img-circle" alt="" src="{{$user->avatar}}">
			</a>
			<div class="media-body">
				<h4 class="media-heading"><a href="getprofile/{{$user->id}}">{{$user->username}}</a></h4>
				{{$user->location}}
			</div>
		</div>
		<br>
		<div style="min-height: 500px">
			@if(count($status)>0)
				@foreach($status as $key)
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
								<li>

									@if(Auth::user()->hasliked($key->id)==0)
										<a href="like/{{$key->id}}">Like</a>
									@else
										<a href="unlike/{{$key->id}}">Unlike</a>
									@endif
								</li>
								<li>
									@if($key->likecount!=0)
										{{$key->likecount}} likes
									@endif
								</li>
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
												<li>

													@if(Auth::user()->hasliked($reply->id)==0)
														<a href="like/{{$reply->id}}">Like</a>
													@else
														<a href="unlike/{{$reply->id}}">Unlike</a>
													@endif
												</li>
												<li>
													@if($reply->likecount!=0)
														{{$reply->likecount}} likes
													@endif
												</li>
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
    </div>
    <div class="col-lg-4 col-lg-offset-3">

		@if($request)
			<h3>Friends, friend requests</h3>
			@foreach($request as $key)
				<div class="row">
					<div class="col-lg-8 media">

						<a class="pull-left" href="friend/{{$key->id}}">
							<img class="media-object img-circle" alt="" src="{{$key->avatar}}">
						</a>
						<div class="media-body">
							<h4 class="media-heading"><a href="friend/{{$key->id}}">{{$key->username}}</a></h4>
							{{$key->location}}
						</div>
					</div>
					<div class="col-lg-2"><a href="getaccept/{{$key->id}}"><p class="btn btn-primary">accept request</p></a></div>
				</div>
			@endforeach
		@endif
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

@endsection