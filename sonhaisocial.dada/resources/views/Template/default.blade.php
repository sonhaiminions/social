<html>
<head>
    <meta charset="utf-8">
    <title>Son Hai Social  </title>

    <base href="{{asset('')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap.min.css')}}">

    <script src="{{asset('admin/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $("#flip").click(function(){
                $("#flip").slideUp("slow");
            });
        });
    </script>
    </head>
<body>
    @include('Template/nav/navigation')
    <div class="container">
        @include('Template/nav/alert')
    @yield('content')
    </div>
</body>
</html>