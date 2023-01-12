<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">Danh sách lịch trình : <strong style="color: #0b2e13"><?php echo e($tour->title); ?></strong></h1>
            <div class="title-actions">
                <a href="<?php echo e(route('tour.admin.schedule.create',$tour->id)); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới lịch trình</a>
            </div>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('Language::admin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="col-md-12">
            <div class="filter-div d-flex justify-content-between ">
                <div class="col-left">

                </div>
            </div>
            <div class="panel">
                <div class="row">
                    <div class="panel-body container-fluid">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th width="60px"><input type="checkbox" class="check-all"></th>
                                        <th width="200px"> Ngày khởi hành</th>
                                        <th width="150px"> Ngày về</th>
                                        <th width="150px"> Số chỗ</th>
                                        <th width="100px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!is_null($rows)): ?>
                                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><input type="checkbox" name="ids[]" class="check-item" value="<?php echo e($row->id); ?>">
                                                </td>
                                                <td class="title"><?php echo e(showVNdate($row->start_date)); ?></td>
                                                <td><?php echo e(showVNdate($row->end_date)); ?></td>
                                                <td><?php echo e($row->active); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('tour.admin.schedule.edit',$row->id)); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> <?php echo e(__('Edit')); ?></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6"><?php echo e(__("No data")); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <?php echo e($rows->appends(request()->query())->links()); ?>

                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\etrip\modules/Tour/Views/admin/schedule/index.blade.php ENDPATH**/ ?>