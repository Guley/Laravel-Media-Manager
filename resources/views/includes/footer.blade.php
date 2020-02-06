<!---->
<div class="clearfix"></div>
<div class="footer">
	 <div class="container">
	 <p>Copyrights © <?php echo date('Y'); ?> All rights reserved Developed By: <a href="http://gulshan.atspace.co.uk" target="_blank">Gulshan</a></p>
	 </div>
</div>




<script src="{{asset('assets/js/bootstrap.js')}}"> </script>
 @if(isset($add_js))
  @foreach($add_js as $jsObj)
  <script type="text/javascript"  src="{{ Config::get('app.url').'assets/js/'.$jsObj }}" ></script>
@endforeach
 @endempty  


<script src="{{asset('assets/js/classie.js')}}"></script>
<script>
	var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
		showLeftPush = document.getElementById( 'showLeftPush' ),
		body = document.body;
		
	showLeftPush.onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( body, 'cbp-spmenu-push-toright' );
		classie.toggle( menuLeft, 'cbp-spmenu-open' );
		disableOther( 'showLeftPush' );
	};
	

	function disableOther( button ) {
		if( button !== 'showLeftPush' ) {
			classie.toggle( showLeftPush, 'disabled' );
		}
	}
</script>
<!--scrolling js-->
	<script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
	<script src="{{asset('assets/js/scripts.js')}}"></script>
	<!--//scrolling js-->
	
	<!-- side nav js -->
	<script src="{{asset('assets/js/SidebarNav.min.js')}}" type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>


  
@if(isset($add_custom_js))
@foreach($add_custom_js as $addjsObj)
  @include($addjsObj)
 @endforeach
@endif