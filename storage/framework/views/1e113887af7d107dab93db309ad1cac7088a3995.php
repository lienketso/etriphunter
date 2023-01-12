<?php $__env->startSection('head'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<h2 class="title-bar">
    <?php echo e(__("Schedule edit")); ?>

</h2>
<?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="panel">
    <div class="panel-title">Tour Name : <strong><?php echo e($row->title); ?></strong></div>
    <div class="panel-body">
        <form action="<?php echo e(route('tour.vendor.storeschedule',['target_id'=>$row->id,'id'=>($date->id) ? $date->id : '-1'])); ?>" method="post">
            <?php echo csrf_field(); ?>
        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo e(__('Start date')); ?></label>
                <input type="text" value="<?php echo e(old('start_date',$date->start_date ? date("m/d/Y",strtotime($date->start_date)) :'')); ?>"
                       placeholder="<?php echo e(__('Start date')); ?>" name="start_date" class="form-control date-picker">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo e(__('End date')); ?></label>
                <input type="text" value="<?php echo e(old('end_date',$date->end_date ? date("m/d/Y",strtotime($date->end_date)) :'')); ?>"
                       placeholder="<?php echo e(__('End date')); ?>" name="end_date" class="form-control date-picker">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label><?php echo e(__("Active")); ?></label>
                <input type="text" name="active"  value="<?php echo e($date->active); ?>" placeholder="<?php echo e(__("Active slot")); ?>" class="form-control">
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> <?php echo e(__('Save Changes')); ?></button>
        </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\etrip\themes/Mytravel/Tour/Views/frontend/manageTour/tour-scheduledit.blade.php ENDPATH**/ ?>