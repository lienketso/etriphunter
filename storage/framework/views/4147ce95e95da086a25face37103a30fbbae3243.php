<?php $__env->startSection('head'); ?>
    <style type="text/css">
        .content-privilege{
            padding: 50px 0;
        }
        .list-privilege{
            text-align: center;
        }
        .list-privilege ul{
            list-style: none;
        }
        .list-privilege ul li{
            border-top: 1px solid #ccc;
            padding: 10px 0
        }
        .list-privilege .btn-book-package{
            margin-top: 25px;
        }
        .list-privilege .btn-book-package a{
            padding: 10px 20px;
            background: #297cbb;
            color: #fff;
            text-align: center;
            width: 160px;
            display: block;
            margin: 0 auto;
            border-radius: 5px;
            font-weight: bold;
        }
        .list-privilege .btn-book-package a:hover{
            background: #1d508d;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-template-content content-privilege">
        <div class="container">
            <div class="w-md-80 w-lg-50 text-center mx-md-auto pb-1 pt-3">
                <h2 class="section-title text-black font-size-30 font-weight-bold">Các gói thành viên</h2>
            </div>
            <div class="row">
                <?php $__currentLoopData = $listPrivilege; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <div class="list-privilege">
                        <img class="img-fluid pb-5" src="<?php echo e(get_file_url($d->image_id,'medium')); ?>" alt="<?php echo e($d->privilege_name); ?>">
                        <h5 class="font-size-17 text-dark font-weight-bold mb-2">
                            <a href=""><?php echo e($d->privilege_name); ?></a></h5>
                        <div class="text-gray-1 px-xl-2 px-uw-7">
                            <?php echo $d->description; ?>

                        </div>
                        <div class="btn-book-package">
                            <a href="<?php echo e(route('user.purchase_privilege',['id'=>$d->id])); ?>"><?php echo e(format_money_main($d->price)); ?></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubgmart.com/public_html/etrip/themes/Mytravel/Privilege/Views/frontend/blocks/index.blade.php ENDPATH**/ ?>