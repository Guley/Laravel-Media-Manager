<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
              
                   @yield('content')
              <div class="clearfix"></div>
     
    <footer class="row">
        @include('auth.authfooter')
    </footer>
</body>
</html>

