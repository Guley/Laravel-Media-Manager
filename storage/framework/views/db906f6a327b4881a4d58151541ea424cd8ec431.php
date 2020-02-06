
<div class="panel panel-default">
    <div class="page-header">
    <div class="container-fluid">

      <?php if(empty(!$sub_nav)): ?>
      <div class="pull-right">
        <?php $__currentLoopData = $sub_nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e($navObj['href']); ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Cancel"><i class="<?php echo e($navObj['icon']); ?>"></i><?php echo e($navObj['title']); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endif; ?>

      <h1><?php echo e($page_title); ?></h1>
      <?php if(empty(!$breadcrumb)): ?>
      <ul class="breadcrumb">
               <?php $__currentLoopData = $breadcrumb; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bkey => $breadcrumbObj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                  $activeflag =((count($breadcrumb)-1)==$bkey)?'active':"";
                ?>
                  <?php if($breadcrumbObj['href']): ?>
                  <li class="<?php echo e($activeflag); ?>" ><a href="<?php echo e($breadcrumbObj['href']); ?>"><?php echo e($breadcrumbObj['title']); ?></a></li>
                  <?php else: ?>
                       <li class="<?php echo e($activeflag); ?>"> <?php echo e($breadcrumbObj['title']); ?> </li>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
        <?php endif; ?>      
    </div>
  </div>
  </div><?php /**PATH /home/gulshan/htdocs/laravel/media-manager/resources/views/includes/breadcrumb.blade.php ENDPATH**/ ?>