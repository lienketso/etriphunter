<div class="row">
    <div class="col-lg-4 col-xl-3 col-md-12">
        <?php echo $__env->make('Tour::frontend.layouts.search.filter-search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="col-lg-8 col-xl-9 col-md-12">
        <div class="bravo-list-item">
            <div class="d-flex justify-content-between align-items-center mb-4 topbar-search">
                <h3 class="font-size-21 font-weight-bold mb-0 text-lh-1">
                    <?php if($rows->total() > 1): ?>
                        <?php echo e(__(":count tours found",['count'=>$rows->total()])); ?>

                    <?php else: ?>
                        <?php echo e(__(":count tour found",['count'=>$rows->total()])); ?>

                    <?php endif; ?>
                </h3>
                <div class="control">
                    <?php echo $__env->make('Tour::frontend.layouts.search.orderby', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <div class="list-item">














                <div class="row">
                    <div class="col-md-12">

                            <?php if($rows->total() > 0): ?>
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item-list">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="thumb-image">
                                        <a href="<?php echo e($row->getDetailUrl($include_param ?? true)); ?>">
                                            <img class="img-responsive" src="<?php echo e($row->image_url); ?>" alt="<?php echo clean($row->title); ?>">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="item-title">
                                        <a href="<?php echo e($row->getDetailUrl($include_param ?? true)); ?>"><?php echo e($row->title); ?></a>
                                    </div>
                                    <div class="location">
                                        <i class="icofont-wall-clock"></i> Số ngày : <?php echo e($row->date_form_to); ?>

                                    </div>
                                    <div class="location">
                                        <i class="icofont-money"></i>
                                        <?php if(!is_null($row->sale_price)): ?>
                                            <?php echo e(__('Price')); ?> :
                                            <span class="price-sale"><?php echo e(format_money_main($row->sale_price)); ?></span>
                                            <span class="price"><?php echo e(format_money_main($row->price)); ?></span>
                                        <?php else: ?>
                                            <span class="price-sale"><?php echo e(format_money_main($row->price)); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="location">
                                        <i class="icofont-delivery-time"></i> Ngày khởi hành : <?php echo e(showVNdate($row->departure_day)); ?>

                                    </div>
                                    <div class="location">
                                        <i class="icofont-users"></i> Số chỗ còn nhận : <?php echo e($row->slots); ?>

                                    </div>
                                    <div class="location">
                                        <i class="icofont-user"></i> <?php echo e(__('Vendor')); ?> :
                                        <a href="<?php echo e(route('user.profile',['id'=>$row->vendor->user_name ?? $row->vendor->id])); ?>" target="_blank"><?php echo e($row->vendor->name); ?></a>
                                    </div>
                                    <div class="book-button">
                                        <a class="book-list-tour" href="<?php echo e($row->getDetailUrl($include_param ?? true)); ?>"><?php echo e(__('Book now')); ?></a>
                                    </div>
                                </div>
                            </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <div class="col-lg-12">
                                            <?php echo e(__("Tour not found")); ?>

                                        </div>
                                    <?php endif; ?>
                    </div>
                </div>

            </div>
            <?php if($rows->total() > 0): ?>
                <div class="text-center text-md-left font-size-14 mb-3 text-lh-1"><?php echo e(__("Showing :from - :to of :total Tours",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()])); ?></div>
            <?php endif; ?>
            <?php echo e($rows->appends(request()->query())->links()); ?>

        </div>
    </div>
</div>
<?php /**PATH /home/ubgmart.com/public_html/etrip/themes/Mytravel/Tour/Views/frontend/layouts/search/list-item.blade.php ENDPATH**/ ?>