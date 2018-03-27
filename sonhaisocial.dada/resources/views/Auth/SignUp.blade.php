@extends('Template/default')
@section('content')

    <div class="row">
        <div class="col-lg-6">
            <form class="form-vertical"   method="post" action="signup">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group {{ $errors -> has('email')? 'has-error':''}}">
                    <label for="email" class="control-label">Your email address</label>
                    <input type="email" name="email" class="form-control" id="email" value="">
                    @if($errors->has('email'))
                        <div>{{$errors->first('email')}}</div>
                    @endif
                </div>

                <div class="form-group {{ $errors -> has('username')? 'has-error':''}}">
                    <label for="username" class="control-label">Choose a username</label>
                    <input type="text" name="username" class="form-control" id="username" value="">
                     @if($errors->has('username'))
                        <div>{{$errors->first('username')}}</div>
                    @endif
                </div>
                <div class="form-group {{ $errors -> has('password')? 'has-error':''}}">
                    <label for="password" class="control-label">Choose a password</label>
                    <input type="password" name="password" class="form-control" id="password">
                     @if($errors->has('password'))
                        <div>{{$errors->first('password')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Sign up</button>
                </div>
            </form>
        </div>
    </div>
@endsection