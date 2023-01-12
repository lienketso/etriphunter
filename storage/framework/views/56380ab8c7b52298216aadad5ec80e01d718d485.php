
<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(asset('/themes/mytravel/dist/frontend/module/event/css/event.css?_ver='.config('app.version'))); ?>" rel="stylesheet">
<style type="text/css">
    .slider-search-location{
        padding-bottom: 30px;
    }
    .item-location a{
        display: block;
        min-height: 400px;
        width: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .table-list-tour table{
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ccc;
    }
    .table-list-tour table tr td{
        border: 1px solid #ccc;
        padding: 10px;
    }
    .book-list-tour{
        background: #d42681;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
    }
    .book-list-tour:hover{
        background: #5191fa;
        color: #fff;
    }
    .item-list{
        padding-bottom: 30px;
    }
    .item-title{
        font-weight: bold;
    }
    .item-title a{
        color: #000;
    }
    .item-title a:hover{
        color: #5191fa;
    }
    .location{
        font-size: 15px;
        padding: 3px 0;
    }
    .location span{
        padding-right: 10px;
    }
    .book-button{
        text-align: right;
    }
    .price-sale{
        color: #cc0033 !important;
        text-decoration: line-through;
    }
    .price{
        font-weight: bold;
        color: #000;
    }
    .logo-vendor{
        text-align: center;
        width: 100%;
    }
    .info-vendor-page h3{
        font-size: 20px;
        font-weight: bold;
    }
    .list-item-vendor{
        padding-bottom: 20px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="bravo_search_tour mt-7">
        <div class="container">
            <div class="row">
            <div class="col-lg-3">
                <div class="info-vendor-page">
                    <div class="logo-vendor">
                        <img src="<?php echo e(get_file_url($vendor->avatar_id,'thumb','')); ?>" alt="<?php echo e($vendor->name); ?>">
                    </div>
                    <h3><?php echo e($vendor->name); ?></h3>
                    <p>Địa chỉ : <?php echo e($vendor->address); ?></p>
                    <div class="desction-vendor">
                        <?php echo $vendor->bio; ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="list-item-vendor">
                    <div class="bravo-list-item">

                            <div class="row">

                                    <?php if($tours->total() > 0): ?>
                                    <div class="col-lg-12">
                                        <h4>Dịch vụ tour</h4>
                                    </div>
                                       <?php $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <div class="col-md-6 col-lg-4 col-xl-4 mb-4 mb-md-4 pb-1">
                                               <div class="list-item-vendor">
                                                <?php echo $__env->make('Vendor::frontend.list-tour', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                               </div>
                                           </div>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div class="col-lg-12">
                                            <?php echo e(__("Tour not found")); ?>

                                        </div>
                                    <?php endif; ?>

                                    <?php if($hotel->total() > 0): ?>
                                            <div class="col-lg-12">
                                                <h4>Khách sạn</h4>
                                            </div>
                                            <?php $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-6 col-lg-4 col-xl-4 mb-4 mb-md-4 pb-1">
                                                <?php echo $__env->make('Vendor::frontend.list-hotel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                        <?php if($cars->total() > 0): ?>
                                            <div class="col-lg-12">
                                                <h4>Dịch vụ xe</h4>
                                            </div>
                                            <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-6 col-lg-4 col-xl-4 mb-4 mb-md-4 pb-1">
                                                    <?php echo $__env->make('Vendor::frontend.list-car', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <?php if($flight->total() > 0): ?>
                                            <div class="col-lg-12">
                                                <h4>Vé máy bay</h4>
                                            </div>
                                            <?php $__currentLoopData = $flight; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-6 col-lg-4 col-xl-4 mb-4 mb-md-4 pb-1">
                                                    <?php echo $__env->make('Vendor::frontend.list-flight', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <?php if($utilities->total() > 0): ?>
                                            <div class="col-lg-12">
                                                <h4>Tiện ích</h4>
                                            </div>
                                            <?php $__currentLoopData = $utilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-6 col-lg-4 col-xl-4 mb-4 mb-md-4 pb-1">
                                                    <?php echo $__env->make('Vendor::frontend.list-utilities', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                </div>

                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\etrip\modules/Vendor/Views/frontend/index.blade.php ENDPATH**/ ?>