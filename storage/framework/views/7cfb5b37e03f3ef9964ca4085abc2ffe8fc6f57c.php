<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">Tất cả đơn vị</h1>
            <div class="title-actions">
                <a href="<?php echo e(route('company.admin.create')); ?>" class="btn btn-primary">Thêm đơn vị</a>
            </div>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="col-md-12">
            <div class="filter-div d-flex justify-content-between ">
                <div class="col-left">
                    <?php if(!empty($rows)): ?>
                        <form method="post" action=""
                              class="filter-form filter-form-left d-flex justify-content-start">
                            <?php echo e(csrf_field()); ?>

                            <select name="action" class="form-control">
                                <option value=""><?php echo e(__(" Bulk Actions ")); ?></option>



                            </select>
                            <button data-confirm="<?php echo e(__("Do you want to delete?")); ?>" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button"><?php echo e(__('Apply')); ?></button>
                        </form>
                    <?php endif; ?>
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
                                        <th width="200px"> Tên công ty</th>
                                        <th width="100"> Logo</th>
                                        <th width="100"> GPKD</th>
                                        <th width="150px"> Mã số thuế</th>
                                        <th width="100px"> Điện thoại</th>
                                        <th width="100px"> Email</th>
                                        <th width="100px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!is_null($rows)): ?>
                                        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><input type="checkbox" name="ids[]" class="check-item" value="<?php echo e($row->id); ?>">
                                                </td>
                                                <td class="title"><?php echo e($row->name); ?></td>
                                                <td ><img src="<?php echo e(get_file_url($row->logo)); ?>" width="70"></td>
                                                <td ><a href="<?php echo e(get_file_url($row->file_company)); ?>" target="_blank">Xem file</a></td>
                                                <td><?php echo e($row->tax_id); ?></td>
                                                <td><?php echo e($row->phone); ?></td>
                                                <td><?php echo e($row->email); ?></td>
                                                <td>
                                                    <a href="<?php echo e(route('company.admin.edit',['id'=>$row->id])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> <?php echo e(__('Edit')); ?></a>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\etrip\modules/Company/Views/admin/index.blade.php ENDPATH**/ ?>