<title>Media-Manager</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Portal" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="{{asset('assets/css/bootstrap.css')}}" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="{{asset('assets/css/style.css')}}" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS-->
<link href="{{asset('assets/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

 <!-- side nav css file -->
 <link href="{{asset('assets/css/SidebarNav.min.css')}}" media='all' rel='stylesheet' type='text/css'/>
 <!-- side nav css file -->
 
 <!-- js-->
<script src="{{asset('assets/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('assets/js/modernizr.custom.js')}}"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts-->
 
<!-- Metis Menu -->
<script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/colors.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/colors.min.css')}}" rel="stylesheet">
  @if(isset($add_css))
      @foreach($add_css as $cssObj)
      <link href="{{ Config::get('app.url').'assets/css/'.$cssObj }}" rel="stylesheet">
    @endforeach
     @endempty  
