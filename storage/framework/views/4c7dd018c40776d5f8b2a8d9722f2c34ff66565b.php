<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(asset('module/vendor/css/vendor-register.css?_ver='.config('app.asset_version'))); ?>" rel="stylesheet">
    <style type="text/css">
        .list-service-vendor span{
            padding-right: 5px;
            font-size: 13px;
        }
    </style>
<?php $__env->stopSection(); ?>
<div class="container">
    <div class="bravo-vendor-form-register py-5 <?php if(!empty($layout)): ?> <?php echo e($layout); ?> <?php endif; ?>">
        <form class="form bravo-form-register-vendor" method="post" action="<?php echo e(route('agency.register')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row">

                <div class="col-12 col-lg-5">
                    <h1><?php echo e($title); ?></h1>
                    <p class="sub-heading"><?php echo e($desc); ?></p>
                    <div class="form-group">
                        <input type="text" class="form-control" name="first_name" autocomplete="off" placeholder="<?php echo e(__("First Name")); ?>">
                        <span class="invalid-feedback error error-first_name"></span>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="last_name" autocomplete="off" placeholder="<?php echo e(__("Last Name")); ?>">
                        <span class="invalid-feedback error error-last_name"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="business_name" autocomplete="off" placeholder="<?php echo e(__("Business Name")); ?>">
                        <span class="invalid-feedback error error-business_name"></span>
                    </div>

                    <div class="form-group">
                        <label>CMT/CCCD / GPKD ( Ảnh chụp hoặc file pdf )</label>
                        <p>Lưu ý : Nếu đại lý là doanh nghiệp vui lòng upload giấy phép kinh doanh</p>
                        <div class="upload-btn-wrapper">
                            <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    <?php echo e(__("Browse")); ?>… <input type="file">
                                </span>
                            </span>
                                <input type="hidden" data-error="<?php echo e(__("Error upload...")); ?>" data-loading="<?php echo e(__("Loading...")); ?>"
                                       class="form-control text-view" readonly value="<?php echo e(get_file_url( old('file_agency') )); ?>">
                            </div>
                            <input type="hidden" class="form-control" name="file_agency" value="<?php echo e(old('file_agency')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <p>Loại đại lý</p>
                        <input type="radio" name="agency_type" value="personal" checked><span>Cá nhân</span>
                        <input type="radio" name="agency_type" value="company"><span>Doanh nghiệp</span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" autocomplete="off" placeholder="<?php echo e(__("Phone")); ?>">
                        <span class="invalid-feedback error error-phone"></span>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" autocomplete="off" placeholder="<?php echo e(__("Email")); ?>">
                        <span class="invalid-feedback error error-email"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" autocomplete="off" placeholder="<?php echo e(__("Password")); ?>">
                        <span class="invalid-feedback error error-password"></span>
                    </div>
                    <div class="form-group">
                        <label for="term">
                            <input id="term" type="checkbox" name="term" class="mr5">
                            <?php echo __("I have read and accept the <a href=':link' target='_blank'>Terms and Privacy Policy</a>",['link'=>get_page_url(setting_item('vendor_term_conditions'))]); ?>

                            <span class="checkmark fcheckbox"></span>
                        </label>
                        <div><span class="invalid-feedback error error-term"></span></div>
                    </div>
                    <?php if(setting_item("user_enable_register_recaptcha")): ?>
                        <div class="form-group">
                            <?php echo e(recaptcha_field($captcha_action ?? 'register_vendor')); ?>

                            <div><span class="invalid-feedback error error-g-recaptcha-response"></span></div>
                        </div><!--End form-group-->
                    <?php endif; ?>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-submit">
                            <?php echo e(__('Sign Up')); ?>

                            <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true" style="display: none"></span>
                        </button>
                    </div>
                    <div class="message-error"></div>

                </div>
                <div class="col-md-1"></div>
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label>Giới thiệu về đại lý</label>
                        <textarea name="bio" class="d-none has-ckeditor" id="vendorCk" cols="30" rows="20"></textarea>
                    </div>

                </div>

            </div>
        </form>
    </div>
</div>
<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" src="<?php echo e(asset("/libs/tinymce/js/tinymce/tinymce.min.js?_ver=".config('app.version'))); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset("/module/user/js/register.js?_ver=".config('app.version'))); ?>"></script>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\laragon\www\etrip\themes/Base/User/Views/frontend/agency/form-register.blade.php ENDPATH**/ ?>