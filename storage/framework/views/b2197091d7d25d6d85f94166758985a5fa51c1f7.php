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













<?php if($rows->total() > 0): ?>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th > <?php echo e(__('Tour Name')); ?></th>
                <th width="80px"> Giá từ</th>
                <th width="200px"> Ngày khởi hành</th>
                <th width="80px"> Số chỗ</th>
                <th width="100px"></th>
            </tr>
        </thead>
                <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td >
                    <?php echo e($row->title); ?>

                    <p style="margin-bottom: 0; font-size: 14px;"><strong>Đơn vị </strong> : <?php echo e((!is_null($row->company_id) ? $row->company->name : 'Chưa rõ')); ?></p>
                </td>
                <td > <?php echo e(format_money_main($row->price)); ?></td>
                <td class="text-center">
                    <a href="javascript::void" data-toggle="modal" data-target="#modelId<?php echo e($row->id); ?>"><i class="flaticon-calendar text-primary font-weight-semi-bold"></i></a>
                </td>
                <td > <?php echo e($row->max_people); ?></td>
                <td>
                    <div class="book-button">
                        <a class="book-list-tour" href="<?php echo e($row->getDetailUrl($include_param ?? true)); ?>"><?php echo e(__('Book')); ?></a>
                    </div>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="modelId<?php echo e($row->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Lịch khởi hành</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="list-kh">
                                <div class="item-shedule">
                                    <?php if(!empty($row->tourDate)): ?>
                                        <?php $__currentLoopData = $row->tourDate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span><?php echo e(showVNdate($d->start_date)); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

                                    <?php else: ?>
                                        <div class="col-lg-12">
                                            <?php echo e(__("Tour not found")); ?>

                                        </div>
                                    <?php endif; ?>

            </div>
            <?php if($rows->total() > 0): ?>
                <div class="text-center text-md-left font-size-14 mb-3 text-lh-1"><?php echo e(__("Showing :from - :to of :total Tours",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()])); ?></div>
            <?php endif; ?>
            <?php echo e($rows->appends(request()->query())->links()); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\etrip\themes/Mytravel/Tour/Views/frontend/layouts/search/list-item.blade.php ENDPATH**/ ?>