<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(asset('themes/mytravel/dist/frontend/module/tour/css/tour.css?_ver='.config('app.asset_version'))); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("themes/mytravel/libs/ion_rangeslider/css/ion.rangeSlider.min.css")); ?>"/>
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
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="bravo_search_tour mt-7">
        <div class="container">
            
            <?php if(!empty($trip_ideas)): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider-search-location bravo-gallery-location ">
                            <div class="item-search-location owl-carousel">
                                <?php $__currentLoopData = $trip_ideas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="item-location">
                                        <a href="<?php echo e($d['link']); ?>"
                                           target="_blank"
                                           style="background-image: url('<?php echo e(get_file_url($d['image_id'],'thumb')); ?>')">
                                        </a>
                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php echo $__env->make('Tour::frontend.layouts.search.list-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script type="text/javascript">
        $(".bravo-gallery-location").each(function () {
            $(this).find(".owl-carousel").owlCarousel({
                items: 1,
                loop: true,
                margin: 0,
                nav: false,
                dots: true,
                autoplay: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })
        });
    </script>
    <script type="text/javascript" src="<?php echo e(asset("themes/mytravel/libs/ion_rangeslider/js/ion.rangeSlider.min.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('themes/mytravel/module/tour/js/tour.js?_ver='.config('app.asset_version'))); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubgmart.com/public_html/etrip/themes/Mytravel/Tour/Views/frontend/search.blade.php ENDPATH**/ ?>