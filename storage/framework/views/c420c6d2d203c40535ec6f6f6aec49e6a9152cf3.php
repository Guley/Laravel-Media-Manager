<?php $__env->startSection('content'); ?>

<div id="page-wrapper">

	       		<div class="main-page">
                    <button type="button" onclick="loadUploaderWithGallery('.txt_container', 'media_test', 'single')" class="btn btn-primary"><i class="fa fa-upload"></i></button>
                    <div class="panel panel-default">
                    
				<div class="table-responsive">
                     <?php echo $__env->make('includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
           		 <table class="table table-striped">
	                <thead>
	                    <tr>
	                        <th>#</th>
	                        <th>Name</th>
	                        <th>Module</th>
	                        <th>Size</th>
	                        <th>Created</th>
	                        <th>&nbsp;</th>
	                    </tr>
	                </thead>
                <tbody>
                        <?php $__currentLoopData = $mediaData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><img src="<?php echo e($media->base_url.'/small/'.$media->file_name); ?>" class="img-responsive thumb" width="50" height="50" data-cdn="<?php echo e(Config::get('constants.CND_PATH')); ?>" data-url="<?php echo e(Config::get('app.url').'media/singlemedia/'); ?>" data-id="" /></td>
                        <td><?php echo e(substr($media->original_name,0,10)); ?>...</td>
                        <td><?php echo e($media->module); ?></td>
                        <td><?php echo e($media->file_size); ?></td>
                        <td><?php echo e(dateformat($media->created_at,'datetime')); ?></td>
                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="text-danger-600"><a onclick="return confirm('Are you sure you want to delete?')" href="<?php echo e(url('media/delete/'.$media->media_id)); ?>"><i class="fa fa-trash"></i></a></li>
                            </ul>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($mediaData->links()); ?>

        </div>
        </div>
			</div>
            
		</div>
<?php echo $__env->make('admin.media.gallery-inline-js',['module' => 'Common', 'base_url'=> Config::get('app.url')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gulshan/htdocs/laravel/media-manager/resources/views/media/list.blade.php ENDPATH**/ ?>