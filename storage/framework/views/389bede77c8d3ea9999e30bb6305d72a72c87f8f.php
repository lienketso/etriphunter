

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__("Agency Requests")); ?></h1>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="filter-div d-flex justify-content-between ">

        </div>
        <div class="text-right">
            <p><i><?php echo e(__('Found :total items',['total'=>$rows->total()])); ?></i></p>
        </div>
        <div class="panel">
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="60px"><input type="checkbox" class="check-all"></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Email')); ?></th>
                                <th><?php echo e(__('Phone')); ?></th>
                                <th class="date">Loại đại lý</th>
                                <th>File</th>
                                <th><?php echo e(__('Approve')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($rows->total() > 0): ?>
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="<?php echo e($row->id); ?>" class="check-item"></td>
                                        <td class="title">
                                            <a href=""><?php echo e($row->name); ?></a>
                                        </td>
                                        <td><?php echo e($row->email); ?></td>
                                        <td><?php echo e($row->phone); ?></td>
                                        <td><?php echo e(($row->agency_type=='personal') ? 'Cá nhân' : 'Doanh nghiệp'); ?></td>
                                        <td>
                                            <a href="<?php echo e(get_file_url($row->file_agency,'thumb','')); ?>" target="_blank">Xem file</a>
                                        </td>
                                        <td>
                                            <?php if($row->is_agency!=1): ?>
                                                <a class="btn btn-sm btn-info" href="<?php echo e(route('user.admin.getUserAgency.upgrade',$row->id)); ?>"><?php echo e(__('Approve')); ?></a>
                                                <?php else: ?>
                                                <span>Đã xác nhận</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8"><?php echo e(__("No data")); ?></td>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script.body'); ?>
    <script>
        $(document).ready(function () {
            $('.approve-user').click(function (e) {
                e.preventDefault();
                if(confirm('Are you sure approve?')){
                    ids = '<input type="hidden" name="ids[]" value="'+$(this).data('id')+'">';
                    form = $('.dungdt-apply-form-btn').closest('form');
                    form.append(ids);
                    form.find('select').val('approved');
                    form.submit();
                }
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\etrip\modules/User/Views/admin/upgrade-agency.blade.php ENDPATH**/ ?>