<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('company.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])); ?>" method="post" class="needs-validation" novalidate>
        <?php echo csrf_field(); ?>
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e($row->id ? __('Edit: ').$row->name : 'Thêm đơn vị mới'); ?></h1>
                </div>
            </div>

            <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title"><strong>Thông tin đơn vị</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên đơn vị</label>
                                        <input type="text" value="<?php echo e($row->name); ?>" name="name" placeholder="Tên đơn vị" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mã số thuế</label>
                                        <input type="text" required value="<?php echo e($row->tax_id); ?>" placeholder="Mã số thuế" name="tax_id" class="form-control"  >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" value="<?php echo e($row->email); ?>" placeholder="Địa chỉ email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input type="text" name="phone" required value="<?php echo e($row->phone); ?>" placeholder="Số điện thoại" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" name="address" value="<?php echo e($row->address); ?>" placeholder="Địa chỉ" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Giới thiệu đơn vị</label>
                                        <textarea name="content" class="d-none has-ckeditor" placeholder="Nội dung" cols="30" rows="10"><?php echo e($row->content); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title"> Giấy phép kinh doanh</h3>
                            <div class="form-group">
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('file_company',$row->file_company); ?>

                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title"> Logo</h3>
                            <div class="form-group">
                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('logo',$row->logo); ?>

                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span></span>
                        <button class="btn btn-primary" type="submit"><?php echo e(__('Save Change')); ?></button>
                    </div>
                </div>
            </div>
        </div>



    </form>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script.body'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\etrip\modules/Company/Views/admin/create.blade.php ENDPATH**/ ?>