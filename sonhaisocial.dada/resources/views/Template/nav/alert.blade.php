        @if (Session::has('info'))
            <div class="alert alert-info" id="flip">
                {{Session::get('info')}}
            </div>
        @endif
