<?php $__env->startSection('title','Privilege'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar"><?php echo e(__("User Privileges")); ?></h1>
        </div>
        <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>         
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th > <?php echo e(__('Username')); ?></th>
                                    <th > <?php echo e(__('Privilege')); ?></th>
                                    <th > <?php echo e(__('Amount')); ?></th>
                                    <th > <?php echo e(__('Available')); ?></th>
                                    <th ></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!is_null($data)): ?>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                                      
                                        <tr>
                                            <td><?php echo e($row->name); ?></a></td>
                                            <td><?php echo e($row->privilege->privilege_name); ?></td>
                                            <td><?php echo e($row->privilege_amount); ?></td>
                                            <td><?php echo e($row->privilege_available); ?></td> 
                                            <td>
                                                <a href="<?php echo e(route('privilege.admin.userdetail',['id'=>$row->id])); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> <?php echo e(__('Edit')); ?></a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubgmart.com/public_html/etrip/modules/Privilege/Views/admin/user.blade.php ENDPATH**/ ?>