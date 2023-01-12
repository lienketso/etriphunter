<?php $__env->startSection('head'); ?>
<style type="text/css">
    .media-left{
        max-width: 150px;
    }
    .media-body .media-heading{
        font-size: 18px;
    }
    .media-left img{
        max-width: 100%;
    }
    .media-body{
        padding-left: 20px;
    }
    .review-item{
        padding-bottom: 50px;
    }
    .review-star{
        display: inline-flex;
        list-style: none;
    }
    .review-star li{
        padding-right: 10px;
    }
    .review-star li i{
        color: burlywood;
    }
    .review-item-body h4{
        font-size: 16px;
        font-weight: bold;
        padding-top: 5px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-profile-content page-template-content">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-3">
                    <?php echo $__env->make('User::frontend.profile.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-md-9">
                    <h3 class="profile-name"><?php echo e(__("Hi, I'm :name",['name'=>(!is_null($user->company_id)) ? $user->company->name : $user->business_name])); ?></h3>
                    <div class="profile-bio"><?php echo (!is_null($user->company_id)) ? $user->company->content : $user->bio; ?></div>
                    <?php echo $__env->make('User::frontend.profile.services', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="div" style="margin-top: 40px;">
                        <?php echo $__env->make('User::frontend.profile.reviews', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\etrip\themes/Base/User/Views/frontend/profile/profile.blade.php ENDPATH**/ ?>