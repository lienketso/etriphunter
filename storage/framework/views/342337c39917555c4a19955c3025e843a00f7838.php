<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(asset('themes/mytravel/dist/frontend/module/flight/css/flight.css?_ver='.config('app.asset_version'))); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset("themes/mytravel/libs/ion_rangeslider/css/ion.rangeSlider.min.css")); ?>"/>
    <style type="text/css">
        .slider-search-location{
            padding-top: 50px;
        }
        .item-location a{
            display: block;
            min-height: 400px;
            width: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo_search_flight">
        <div class="bg-gray-33 py-1">
            <div class="container">
                <div class="border-0">
                    <div class="card-body pl-0 pr-0">
                        <?php if ($__env->exists('Flight::frontend.layouts.search.form-search')) echo $__env->make('Flight::frontend.layouts.search.form-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>

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
            <?php echo $__env->make('Flight::frontend.layouts.search.list-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" src="<?php echo e(asset("themes/mytravel/libs/ion_rangeslider/js/ion.rangeSlider.min.js")); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('themes/mytravel/module/flight/js/flight.js?_ver='.config('app.asset_version'))); ?>"></script>
    <script>
        $(document).ready(function () {
            $.BCoreModal.init('[data-modal-target]');
        })
    </script>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubgmart.com/public_html/etrip/themes/Mytravel/Flight/Views/frontend/search.blade.php ENDPATH**/ ?>