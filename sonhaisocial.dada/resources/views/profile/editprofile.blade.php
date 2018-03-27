
@extends('Template/default')
@section('content')

   <h3>Update your profile</h3>

<div class="row">
    <div class="col-lg-6">
        <form class="form-vertical" role="form" method="post" action="posteditprofile/{{$user['id']}}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group {{ $errors -> has('firstname')? 'has-error':''}}">
                        <label for="first_name" class="control-label">First name</label>
                        <input type="text" name="firstname" class="form-control" id="first_name" value="{{$user->firstname}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group {{ $errors -> has('lastname')? 'has-error':''}}">
                        <label for="last_name" class="control-label">Last name</label>
                        <input type="text" name="lastname" class="form-control" id="last_name" value="{{$user->lastname}}">
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors -> has('location')? 'has-error':''}}">
                <label for="location" class="control-label">Location</label>
                <input type="text" name="location" class="form-control" id="location" value="{{$user->location}}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection