<?php $__env->startSection('head'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <h2 class="title-bar">
        <?php echo e(__("Cập nhật hồ sơ đăng ký làm đại lý")); ?>

    </h2>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if($user->is_agency!=1): ?>
    <form action="<?php echo e(route('user.become_agency.post')); ?>" method="post" class="input-has-icon">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <p>Đăng ký đại lý cho :</p>
                    <input type="radio" name="agency_type" <?php echo e(($user->agency_type=='personal') ? 'checked' : ''); ?> value="personal"> <span>Cá nhân</span>
                    <input type="radio" name="agency_type" <?php echo e(($user->agency_type=='company') ? 'checked' : ''); ?> value="company"> <span>Doanh nghiệp</span>
                </div>
                <div class="form-group">
                    <label><?php echo e(__("Upload CCCD / CMT / Hộ chiếu / Giấy phép kinh doanh")); ?></label>
                    <p>Nếu là doanh nghiệp , vui lòng upload Giấy phép kinh doanh</p>
                    <div class="upload-btn-wrapper">
                        <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        <?php echo e(__("Browse")); ?>… <input type="file">
                                    </span>
                                </span>
                            <input type="text" data-error="<?php echo e(__("Error upload...")); ?>" data-loading="<?php echo e(__("Loading...")); ?>" class="form-control text-view"
                                   readonly value="<?php echo e(get_file_url( old('file_agency',$user->file_agency) ) ?? $user->getAvatarUrl()?? __("No Image")); ?>">
                        </div>
                        <input type="hidden" class="form-control" name="file_agency" value="<?php echo e(old('file_agency',$user->file_agency)?? ""); ?>">
                        <img class="image-demo" src="<?php echo e(get_file_url( old('avatar_id',$user->file_agency) ) ??  $user->getAvatarUrl() ?? ""); ?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <hr>
                    <input type="submit" class="btn btn-primary" value="<?php echo e(__("Save changes")); ?>">
                    <a href="<?php echo e(route("user.profile.index")); ?>" class="btn btn-default"><?php echo e(__("Cancel")); ?></a>
                </div>

        </div>
        </div>
    </form>
    <?php else: ?>
        <div class="row">
            <div class="col-lg-6">
                <p style="color: #c00">Bạn đã trở thành đại lý tại Etrip Hunter</p>
                <p>Loại đại lý : <strong><?php echo e(($user->agency_type=='personal') ? 'Cá nhân' : 'Doanh nghiệp'); ?></strong></p>
                <p>Mức chiết khấu : <strong><?php echo e(($user->agency_type=='personal') ? setting_item_with_lang('user_persional_percent') : setting_item_with_lang('user_company_percent')); ?> %</strong></p>
            </div>
        </div>
    <?php endif; ?>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubgmart.com/public_html/etrip/themes/Base/User/Views/frontend/agency/become-agency.blade.php ENDPATH**/ ?>