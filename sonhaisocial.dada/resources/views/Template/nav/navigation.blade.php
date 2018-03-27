
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Chatty</a>
        </div>
        <div class="collapse navbar-collapse">
         @if (Auth::check())
            <ul class="nav navbar-nav">
                <li><a href="timeline">Timeline</a></li>
                <li><a href="#">Friends</a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search" action="searchresult" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" name="query" class="form-control" placeholder="Find people" >
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
         @endif
            <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
                <li><a href="getprofile/{{Auth::user()->id}}">{{Auth::user()->gettest()}}</a></li>
                <li><a href="geteditprofile/{{Auth::user()->id}}">Update profile</a></li>
                <li><a href="logout">Sign out</a></li>
             @else
                <li><a href="signup">Sign up</a></li>
                <li><a href="signin">Sign in</a></li>
            @endif
            </ul>
        </div>
    </div>
</nav>
