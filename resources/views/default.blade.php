<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body class="cbp-spmenu-push">
  <div class="main-content">
    @include('includes.sidebar')
    @yield('content')
    @include('includes.footer')
    
</body>
</html>

