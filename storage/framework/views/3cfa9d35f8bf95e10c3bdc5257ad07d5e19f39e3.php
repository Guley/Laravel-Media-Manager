<!---->
<div class="clearfix"></div>
<div class="footer">
	 <div class="container">
	 <p>Copyrights © <?php echo date('Y'); ?> All rights reserved Developed By: <a href="http://gulshan.atspace.co.uk" target="_blank">Gulshan</a></p>
	 </div>
</div>




<script src="<?php echo e(asset('assets/js/bootstrap.js')); ?>"> </script>
 <?php if(isset($add_js)): ?>
  <?php $__currentLoopData = $add_js; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jsObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <script type="text/javascript"  src="<?php echo e(Config::get('app.url').'assets/js/'.$jsObj); ?>" ></script>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php endif; ?>  


<script src="<?php echo e(asset('assets/js/classie.js')); ?>"></script>
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
	<script src="<?php echo e(asset('assets/js/jquery.nicescroll.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/scripts.js')); ?>"></script>
	<!--//scrolling js-->
	
	<!-- side nav js -->
	<script src="<?php echo e(asset('assets/js/SidebarNav.min.js')); ?>" type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>


  
<?php if(isset($add_custom_js)): ?>
<?php $__currentLoopData = $add_custom_js; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addjsObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php echo $__env->make($addjsObj, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH /home/gulshan/htdocs/laravel/media-manager/resources/views/includes/footer.blade.php ENDPATH**/ ?>