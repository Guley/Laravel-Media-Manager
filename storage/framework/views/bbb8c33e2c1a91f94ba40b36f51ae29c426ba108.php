<?php $__env->startSection('content'); ?>
<div id="page-wrapper">
 <?php echo $__env->make('includes.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	       		<div class="main-page">
                    <?php echo $__env->make('includes.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                    <div class="panel panel-default">
                        <div class="panel-body">
                             <?php echo e(Form::open(array('url' => '', 'method' => 'post', 'class' => 'form-horizontal'))); ?>

                                <div class="form-group ">
                                        <?php echo e(Form::label('sample_title', 'Sample Title', array('class' => 'col-sm-2 control-label'))); ?>

                                    <div class="col-sm-10">
                                        <?php echo e(Form::text('sample_title',null,array('class' => 'form-control','placeholder'=>'Sample Title'))); ?>

                                    </div>
                                  </div>
                                 <div class="form-group"> 
                                        <?php echo e(Form::label('image', 'Image', array('class' => 'col-sm-2 control-label'))); ?>

                                    <div class="col-sm-10">
                                         <button type="button" onclick="loadUploaderWithGallery('.txt_container', 'media_id', 'single')" class="btn btn-primary"><i class="fa fa-upload"></i></button>
                                         <div class="row txt_container">

                                            <?php echo e(Form::hidden('media_id',0)); ?>

                                        </div>
                                        <div class="row selected_images">
                                            <?php if(($sampleMedia) &&($sampleMedia['media_id'])): ?>
                            <div class="col-lg-2 col-sm-3 img_<?php echo e($sampleMedia['media_id']); ?>" >
                                <div class="thumbnail">
                                     <div class="thumb">
                                     <img src="<?php echo e(asset('assets/uploads/'. $sampleMedia['file_path'].'/small/'.$sampleMedia['file_name'])); ?>" alt="">
                                     <div class="caption-overflow">
                                            <span><a href="javascript:void(0);" class="btn border-white text-white btn-flat btn-icon btn-rounded" onclick="removeImg($sampleMedia['media_id'], 'single', '.txt_container', 'media_id')" ><i class="fa fa-trash"></i></a><h6 class="no-margin image_title"> <?php echo e($sampleMedia["file_name"]); ?> </h6>
                                        </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php endif; ?>
                                     </div>
                                    </div>
                                    </div>

                                <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-primary" disabled="">Submit</button>
                            </div>
                                 <?php echo e(Form::close()); ?> 
                </div>
                </div>
               
			</div>
            
		</div>
<?php echo $__env->make('media.gallery-inline-js',['module' => 'Common', 'base_url'=> Config::get('app.url')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gulshan/htdocs/laravel/media-manager/resources/views//media/sample.blade.php ENDPATH**/ ?>