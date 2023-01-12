<?php $__env->startSection('head'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<h2 class="title-bar">
    <?php echo e(__("Tours Schedule")); ?>

        <a href="<?php echo e(route("tour.vendor.schedulecreate",['target_id'=>$row->id])); ?>" class="btn-change-password"><?php echo e(__("Add Schedule")); ?></a>
</h2>
<?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="panel">
    <div class="panel-title">Tour Name : <strong><?php echo e($row->title); ?></strong></div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="150px"> Ngày khởi hành</th>
                        <th width="150px"> Ngày về</th>
                        <th width="80px"> Số chỗ</th>
                        <th width="100px"></th>
                    </tr>
                </thead>
                        <tbody>
                <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td ><?php echo e(showVNdate($date->start_date)); ?></td>
                        <td ><?php echo e(showVNdate($date->end_date)); ?></td>
                        <td ><?php echo e(($date->active)<=0 ? 'Hết chỗ' : $date->active); ?></td>
                        <td>
                            <a href="<?php echo e(route("tour.vendor.scheduleedit",['target_id'=>$row->id,'id'=>$date->id])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> <?php echo e(__('Edit')); ?></a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\etrip\themes/Mytravel/Tour/Views/frontend/manageTour/tour-schedule.blade.php ENDPATH**/ ?>