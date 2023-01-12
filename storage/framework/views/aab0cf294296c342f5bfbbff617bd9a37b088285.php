<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('privilege.admin.postedit',['id'=>$id ?? -1])); ?>" method="post" class="needs-validation" novalidate>
        <?php echo csrf_field(); ?>
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e($privilege->privilege_name); ?></h1>
                </div>
            </div>

            <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('Privilege')); ?></strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Privilege name")); ?></label>
                                        <input type="text" value="<?php echo e($privilege->privilege_name); ?>" name="privilege_name" placeholder="<?php echo e(__("Privilege_name")); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('Discount')); ?></label>
                                        <input type="text" required value="<?php echo e($privilege->discount); ?>" placeholder="<?php echo e(__('Discount')); ?>" name="discount" class="form-control"  >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Amount")); ?></label>
                                        <input type="text" name="amount" required value="<?php echo e($privilege->amount); ?>" placeholder="<?php echo e(__("Amount")); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Max User")); ?></label>
                                        <input type="text" name="max_user" required value="<?php echo e($privilege->max_user); ?>" placeholder="<?php echo e(__("Max User")); ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Price")); ?></label>
                                        <input type="text" name="price" required value="<?php echo e($privilege->price); ?>" placeholder="<?php echo e(__("Price")); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?php echo e(__("Description")); ?></label>
                                        <textarea name="description" class="d-none has-ckeditor" placeholder="<?php echo e(__("Description")); ?>" cols="30" rows="10"><?php echo e($privilege->description); ?></textarea>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-3">
                        <div class="panel">
                           <div class="panel-title"><strong><?php echo e(__('Publish')); ?></strong></div>
                           <div class="panel-body">
                               <div class="form-group">
                                   <label><?php echo e(__('Status')); ?></label>
                                   <select required class="custom-select" name="status">
                                       <option  value="publish"><?php echo e(__('Publish')); ?></option>
                                       <option  value="draft"><?php echo e(__('Draft')); ?></option>
                                   </select>
                               </div>
                           </div>
                       </div>
                        <div class="panel">
                            <div class="panel-title"><strong><?php echo e(__('Sort order')); ?></strong></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="number" min="0" placeholder="Thứ tụ ưu tiên" name="sort_order" class="form-control" value="<?php echo e($privilege->sort_order); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-body">
                                <h3 class="panel-body-title"> <?php echo e(__('Feature Image')); ?></h3>
                                <div class="form-group">
                                    <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$privilege->image_id); ?>

                                </div>
                            </div>
                        </div>
                       <div class="d-flex justify-content-between">
                           <span></span>
                           <button class="btn btn-primary" type="submit"><?php echo e(__('Save Change')); ?></button>
                       </div>
                   </div>
            </div>
    </form>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script.body'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubgmart.com/public_html/etrip/modules/Privilege/Views/admin/detail.blade.php ENDPATH**/ ?>