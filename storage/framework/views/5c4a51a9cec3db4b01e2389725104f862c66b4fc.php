<?php $__env->startSection('title','Privilege'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__("All Privileges")); ?></h1>
            <div class="title-actions">
                <a href="<?php echo e(route('privilege.admin.getcreate')); ?>" class="btn btn-primary"><?php echo e(__("Add new Privilege")); ?></a>
            </div>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-md-12">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        <?php if(!empty($rows)): ?>
                            <form method="post" action="<?php echo e(route('privilege.admin.bulkEdit')); ?>"
                                  class="filter-form filter-form-left d-flex justify-content-start">
                                <?php echo e(csrf_field()); ?>

                                <select name="action" class="form-control">
                                    <option value=""><?php echo e(__(" Bulk Actions ")); ?></option>
                                    <option value="publish"><?php echo e(__(" Publish ")); ?></option>
                                    <option value="draft"><?php echo e(__(" Move to Draft ")); ?></option>
                                    <option value="delete"><?php echo e(__(" Delete ")); ?></option>
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
                                    <th width="200px"> <?php echo e(__('Name')); ?></th>
                                    <th width="150px"> <?php echo e(__('Max Amount')); ?></th>
                                    <th width="150px"> <?php echo e(__('Price')); ?></th>
                                    <th width="100px"> <?php echo e(__('Discount')); ?></th>
                                    <th width="100px"> <?php echo e(__('User')); ?></th>
                                    <th width="100px"> <?php echo e(__('Status')); ?></th>
                                    <th width="100px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!is_null($rows)): ?>
                                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><input type="checkbox" name="ids[]" class="check-item" value="<?php echo e($row->id); ?>">
                                            </td>
                                            <td class="title"><?php echo e($row->privilege_name); ?></a></td>
                                            <td><?php echo e($row->amount); ?></td>
                                            <td><?php echo e($row->price); ?></td>
                                            <td><?php echo e($row->discount); ?></td>
                                            <td><?php echo e($row->max_user); ?></td>
                                            <td><span class="badge badge-<?php echo e($row->status); ?>"><?php echo e($row->status); ?></span></td>
                                            <td>
                                                <a href="<?php echo e(route('privilege.admin.detail',['id'=>$row->id])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> <?php echo e(__('Edit')); ?></a>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubgmart.com/public_html/etrip/modules/Privilege/Views/admin/index.blade.php ENDPATH**/ ?>