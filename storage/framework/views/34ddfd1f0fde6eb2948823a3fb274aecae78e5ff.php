<?php $__env->startSection('head'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <h2 class="title-bar">
        <?php echo e(__("Upgrade privilege")); ?>

    </h2>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    
            <div class="col-md-12">  
                <div class="panel"> 
                    <div class="row">
                    <div class="panel-body container-fluid">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="200px"> <?php echo e(__('Name')); ?></th>
                                    <th> <?php echo e(__('Description')); ?></th>
                                    <th width="150px"> <?php echo e(__('Max Amount')); ?></th>
                                    <th width="100px"> <?php echo e(__('Discount')); ?></th>
                                    <th width="100px"> <?php echo e(__('User')); ?></th>
                                    <th width="100px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!is_null($rows)): ?>
                                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="title"><?php echo e($row->privilege_name); ?></a></td>
                                            <td><?php echo e($row->description); ?></td>
                                            <td><?php echo e($row->amount); ?></td>
                                            <td><?php echo e($row->discount); ?></td>
                                            <td><?php echo e($row->max_user); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('user.purchase_privilege',['id'=>$row->id])); ?>" class="btn btn-primary btn-sm"><?php echo e(__('Purchase')); ?></a>
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubgmart.com/public_html/etrip/themes/Mytravel/Privilege/Views/frontend/upgrade.blade.php ENDPATH**/ ?>