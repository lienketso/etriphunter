<?php $__env->startSection('head'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <h2 class="title-bar no-border-bottom">
        <?php echo e(__("Booking Request")); ?>

    </h2>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="booking-history-manager">
        <div class="tabbable">
            <ul class="nav nav-tabs ht-nav-tabs">
                <?php $status_type = Request::query('status'); ?>
                    <li class="<?php if(empty($status_type)): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route("vendor.bookingRequestReport")); ?>">Chưa xác nhận</a>
                    </li>
                    <li class="<?php if(!empty($status_type) && $status_type == 'processing'): ?> active <?php endif; ?>">
                            <a href="<?php echo e(route("vendor.bookingRequestReport",['status'=>'processing'])); ?>">Đã xác nhận</a>
                    </li>
            </ul>
            <?php if(!empty($bookings) and $bookings->total() > 0): ?>
                <div class="tab-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-booking-history">
                            <thead>
                            <tr>
                                <th><?php echo e(__("Customer info")); ?></th>
                                <th class="a-hidden"><?php echo e(__("Order Date")); ?></th>
                                <th class="a-hidden"><?php echo e(__("Execution Time")); ?></th>
                                <th><?php echo e(__("Total Guests")); ?></th>
                                <th><?php echo e(__("Location")); ?></th>
                                <th><?php echo e(__("Action")); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('Tour::frontend.bookingRequest.loop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="bravo-pagination">
                        <?php echo e($bookings->appends(request()->query())->links()); ?>

                    </div>
                </div>
            <?php else: ?>
                <?php echo e(__("No Booking History")); ?>

            <?php endif; ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubgmart.com/public_html/etrip/themes/Base/Vendor/Views/frontend/bookingRequest/index.blade.php ENDPATH**/ ?>