<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__('All Bookings')); ?></h1>
        </div>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="filter-div d-flex justify-content-between">
            <div class="col-left">
                <form method="get" action="" class="filter-form filter-form-right d-flex justify-content-end">
                <?php echo csrf_field(); ?>
                    <input type="text" name="s" value="<?php echo e(Request()->s); ?>" placeholder="<?php echo e(__('Name,phone,email,ID')); ?>" class="form-control">
                    <button class="btn-info btn btn-icon" type="submit"><?php echo e(__('Filter')); ?></button>
                </form>
            </div>
        </div>
        <div class="panel booking-history-manager">
            <div class="panel-title"><?php echo e(__('Bookings')); ?></div>
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <table class="table table-hover bravo-list-item">
                        <thead>
                        <tr>
                            <th width="80px"><input type="checkbox" class="check-all"></th>
                            <th><?php echo e(__('Vendor')); ?></th>
                            <th><?php echo e(__('Contact Name')); ?></th>
                            <th width="180px" ><?php echo e(__('Guest info')); ?></th>
                            <th width="200px"><?php echo e(__('Location')); ?></th>
                            <th width="150px"><?php echo e(__('Vehicle')); ?></th>
                            <th width="100px"><?php echo e(__('Hotel')); ?></th>
                            <th width="150px"><?php echo e(__('Time')); ?></th>
                            <th width="120px"><?php echo e(__('Created At')); ?></th>
                            <th width="80px"><?php echo e(__('Actions')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $guest = json_decode($d->persion);
                                $location = json_decode($d->location);
                                $booking = $d;
                            ?>
                        <tr>
                            <td><input type="checkbox" class="check-item" name="ids[]" value="<?php echo e($d->id); ?>"> #<?php echo e($d->id); ?></td>
                            <td><?php echo e(($d->vendor_id!=0) ? $d->vendor->name : 'Chưa chọn vendor'); ?></td>
                            <td>
                                <ul>
                                    <li><?php echo e(__("Company:")); ?> <?php echo e($d->company); ?> </li>
                                    <li><?php echo e(__("Name:")); ?> <?php echo e($d->name); ?> </li>
                                    <li><?php echo e(__("Position:")); ?> <?php echo e($d->office); ?> </li>
                                    <li><?php echo e(__("Email:")); ?> <?php echo e($d->email); ?></li>
                                    <li><?php echo e(__("Phone:")); ?> <?php echo e($d->phone); ?></li>
                                    <li><?php echo e(__("Address:")); ?> <?php echo e($d->address); ?></li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Người lớn : <?php echo e($guest->adult); ?></li>
                                    <li>Trẻ em (6-16) : <?php echo e($guest->child); ?></li>
                                    <li>Trẻ em (2-5) : <?php echo e($guest->young); ?></li>
                                    <li>Trẻ nhỏ ( < 2 ) : <?php echo e($guest->baby); ?></li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Điểm đi : <?php echo e($location->from_where); ?></li>
                                    <li>Điểm đến : <?php echo e($location->to_where); ?></li>
                                </ul>
                            </td>
                            <td>
                                <?php if(!is_null($d->vehicle)): ?>
                                    <?php
                                        $vehicle = json_decode($d->vehicle)
                                    ?>
                                        <?php $__currentLoopData = $vehicle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p style="margin-bottom: 5px;"><?php echo e($val); ?></p>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <p>Chưa chọn</p>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($d->hotel); ?>*</td>
                            <td>
                                <ul>
                                    <li>Ngày đi : <?php echo e(showVNdate($d->start_date)); ?></li>
                                    <li>Ngày về : <?php echo e(showVNdate($d->end_date)); ?></li>
                                </ul>
                            </td>
                            <td><?php echo e(showVNdateFull($d->created_at)); ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(__('Actions')); ?>

                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-booking-request-<?php echo e($d->id); ?>"><?php echo e(__('Detail')); ?></a>
                                        <a class="dropdown-item" href="<?php echo e(route('report.admin.request-edit',$d->id)); ?>" ><?php echo e(__('Edit')); ?></a>
                                    </div>
                                </div>
                                <?php echo $__env->make('Report::admin/bookingrequest.detail-modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </td>
                        </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubgmart.com/public_html/etrip/modules/Report/Views/admin/bookingrequest/index.blade.php ENDPATH**/ ?>