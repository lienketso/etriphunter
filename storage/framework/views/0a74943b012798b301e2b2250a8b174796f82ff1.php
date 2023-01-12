
<?php $__env->startSection('head'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <h2 class="title-bar no-border-bottom">
        <?php echo e(__("Danh sách tài khoản")); ?>

        <a href="<?php echo e(route('vendor.add-user')); ?>" class="btn-change-password">Thêm tài khoản</a>
    </h2>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="booking-history-manager">
        <div class="tabbable">

            <?php if(!empty($user) and $user->total() > 0): ?>
                <div class="tab-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-booking-history">
                            <thead>
                            <tr>
                                <th width="2%"><?php echo e(__("Name")); ?></th>
                                <th><?php echo e(__("Email")); ?></th>
                                <th class="a-hidden"><?php echo e(__("Phone")); ?></th>
                                <th class="a-hidden"><?php echo e(__("Address")); ?></th>
                                <th width="15%"><?php echo e(__("Created at")); ?></th>
                                <th><?php echo e(__("Action")); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($d->name); ?></td>
                                <td><?php echo e($d->email); ?></td>
                                <td><?php echo e($d->phone); ?></td>
                                <td><?php echo e($d->address); ?></td>
                                <td><?php echo e(showVNdate($d->created_at)); ?></td>
                                <td><a class="btn btn-primary" href="<?php echo e(route('vendor.edit-vendor-user',$d->id)); ?>"><i class="fa fa-edit"></i> Sửa</a></td>
                            </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="bravo-pagination">
                        <?php echo e($user->appends(request()->query())->links()); ?>

                    </div>
                </div>
            <?php else: ?>
                Không tìm thấy tài khoản nào
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\etrip\modules/Vendor/Views/frontend/users/index.blade.php ENDPATH**/ ?>