<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('tour.admin.schedule.edit.post',$row->id)); ?>" method="post" class="needs-validation" novalidate>
        <?php echo csrf_field(); ?>
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">Sửa lịch trình </h1>
                </div>
            </div>

            <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if($row->id): ?>
                <?php echo $__env->make('Language::admin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title"><strong>Thông tin lịch trình</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ngày khởi hành</label>
                                        <input type="text" value="<?php echo e($row->start_date ? date_show_input($row->start_date) : date("m/d/Y",strtotime(now()))); ?>"
                                               name="start_date" placeholder="Ngày khởi hành"
                                               class="form-control  has-datetimepicker">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ngày về</label>
                                        <input type="text" required
                                               value="<?php echo e($row->end_date ? date_show_input($row->end_date) : date("m/d/Y",strtotime(now()))); ?>"
                                               placeholder="Ngày về"
                                               name="end_date"
                                               class="form-control has-datetimepicker"  >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Số chỗ</label>
                                        <input type="number" name="active" required value="<?php echo e($row->active); ?>" placeholder="Số chỗ" class="form-control">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('Publish')); ?></strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label><?php echo e(__('Status')); ?></label>
                                <select required class="custom-select" name="status">
                                    <option  value="publish"><?php echo e(__('Publish')); ?></option>
                                    <option  value="draft"><?php echo e(__('Draft')); ?></option>
                                </select>
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
    <script>
        $(document).ready(function () {
            $('.has-datetimepicker').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                showCalendar: false,
                autoUpdateInput: false, //disable default date
                sameDate: true,
                autoApply: true,
                disabledPast: true,
                enableLoading: true,
                showEventTooltip: true,
                classNotAvailable: ['disabled', 'off'],
                disableHightLight: true,
                locale: {
                    format: 'MM/DD/YYYY'
                }
            }).on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\etrip\modules/Tour/Views/admin/schedule/edit.blade.php ENDPATH**/ ?>