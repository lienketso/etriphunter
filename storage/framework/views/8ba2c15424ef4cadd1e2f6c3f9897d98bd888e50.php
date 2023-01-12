<?php $__env->startSection('head'); ?>
    <link href="<?php echo e(asset('dist/frontend/module/booking/css/checkout.css?_ver='.config('app.version'))); ?>" rel="stylesheet">
    <style type="text/css">
        .vehicle-checkbox span{
            padding-right: 10px;
        }
        .required-alert{
            color: #c00;
        }
        .booking-form ul {
            margin-left: 10px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="bravo-booking-page">
        <div id="bravo-checkout-page" class="bg-gray space-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="booking-form">
                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <div class="form-checkout" id="form-booking-request">
                                <form method="post" action="<?php echo e(route('booking.request')); ?>">
                                    <?php echo e(csrf_field()); ?>

                                <div class="mb-5 shadow-soft bg-white rounded-sm">
                                    <div class="pt-4 pb-5 px-5">
                                        <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-4">
                                            <?php echo e(__("Form request a quote")); ?>

                                        </h5>
                                        <div class="row">
                                            <div class="col-sm-12 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Company Name")); ?>

                                                </label>
                                                <input type="text" placeholder="<?php echo e(__("Company Name")); ?>" class="form-control" value="<?php echo e(old('company')); ?>"
                                                       name="company">
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Full Name")); ?> <span class="required-alert"> * </span>
                                                </label>
                                                <input type="text" placeholder="<?php echo e(__("Full Name")); ?>" class="form-control" value="<?php echo e($user->name ?? ''); ?>"
                                                       name="name" >
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Office")); ?>

                                                </label>
                                                <input type="text" placeholder="<?php echo e(__("Office")); ?>" class="form-control" value="<?php echo e(old('office')); ?>"
                                                       name="office" >
                                            </div>
                                            <div class="col-sm-12 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Address")); ?>

                                                </label>
                                                <input type="text" placeholder="<?php echo e(__("Address")); ?>" class="form-control" value="<?php echo e(old('address')); ?>"
                                                       name="address">
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Email")); ?>

                                                </label>
                                                <input type="email" placeholder="<?php echo e(__("email@domain.com")); ?>" class="form-control" value="<?php echo e($user->email ?? ''); ?>"
                                                       name="email">
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Phone")); ?> <span class="required-alert"> * </span>
                                                </label>
                                                <input type="text" placeholder="<?php echo e(__("Your Phone")); ?>" class="form-control" value="<?php echo e($user->phone ?? ''); ?>"
                                                       name="phone">
                                            </div>
                                            <div class="w-100"></div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Start date")); ?> <span class="required-alert"> * </span>
                                                </label>
                                                <input type="text" placeholder="<?php echo e(__("Start date")); ?>" class="form-control has-datetimepicker" value="<?php echo e(old('start_date')); ?>"
                                                       name="start_date">
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("End date")); ?> <span class="required-alert"> * </span>
                                                </label>
                                                <input type="text" placeholder="<?php echo e(__("End date")); ?>" class="form-control has-datetimepicker" value="<?php echo e(old('end_date')); ?>"
                                                       name="end_date" >
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("From where")); ?> <span class="required-alert"> * </span>
                                                </label>
                                                <input type="text" name="location[from_where]" value="<?php echo e(old('location[from_where]')); ?>" placeholder="Ex : Hà Nội" class="form-control" />
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("To where")); ?> <span class="required-alert"> * </span>
                                                </label>
                                                <input type="text" name="location[to_where]" value="<?php echo e(old('location[to_where]')); ?>" placeholder="Ex : Đà Nẵng" class="form-control" />
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Organizational units")); ?>

                                                </label>
                                                <select name="vendor_id" class="form-control">
                                                    <option value=""><?php echo e(__('-- Select --')); ?></option>
                                                    <?php $__currentLoopData = $listVendor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($d->id); ?>"><?php echo e($d->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Hotel type")); ?>

                                                </label>
                                                <input type="text" class="form-control" value="<?php echo e(old('hotel')); ?>" name="hotel"
                                                       placeholder="<?php echo e(__("5*")); ?>">
                                            </div>
                                            <div class="col-sm-12 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Vehicle")); ?>

                                                </label>
                                                <p class="vehicle-checkbox">
                                                    <input type="checkbox" name="vehicle[]" value="<?php echo e(__("Air plane")); ?>" /> <span><?php echo e(__("Air plane")); ?></span>
                                                    <input type="checkbox" name="vehicle[]" value="<?php echo e(__("Train")); ?>" /> <span><?php echo e(__("Train")); ?></span>
                                                    <input type="checkbox" name="vehicle[]" value="<?php echo e(__("Car")); ?>" /> <span><?php echo e(__("Car")); ?></span>
                                                </p>
                                            </div>
                                            <div class="col-sm-3 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Adult")); ?> <span class="required-alert"> * </span>
                                                </label>
                                                <input type="number" min="0" value="<?php echo e(old('persion[adult]',1)); ?>" name="persion[adult]" class="form-control" placeholder="Total of adults">
                                            </div>
                                            <div class="col-sm-3 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Child (6-16 year old)")); ?>

                                                </label>
                                                <input type="number" min="0" value="<?php echo e(old('persion[child]',0)); ?>" name="persion[child]" class="form-control" placeholder="Total of child ">
                                            </div>
                                            <div class="col-sm-3 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Child (2-5 year old)")); ?>

                                                </label>
                                                <input type="number" min="0" value="<?php echo e(old('persion[young]',0)); ?>" name="persion[young]" class="form-control" placeholder="Total of child ">
                                            </div>
                                            <div class="col-sm-3 mb-4">
                                                <label class="form-label">
                                                    <?php echo e(__("Child (<2 year old)")); ?>

                                                </label>
                                                <input type="number" min="0" value="<?php echo e(old('persion[baby]',0)); ?>" name="persion[baby]" class="form-control" placeholder="Total of baby ">
                                            </div>
                                            <div class="w-100"></div>
                                            <div class="col">
                                                <div class="mb-6">
                                                    <label class="form-label">
                                                        <?php echo e(__("Special Requirements")); ?>

                                                    </label>
                                                    <div class="input-group">
                                                        <textarea name="description" cols="30" rows="6" class="form-control" placeholder="<?php echo e(__('Special Requirements')); ?>"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-100"></div>

                                            <div class="col-sm-12 mb-4">
                                                <?php
                                                    $term_conditions = setting_item('booking_term_conditions');
                                                ?>
                                                <div class="mb-3">
                                                    <div class="custom-control custom-checkbox d-flex align-items-center text-muted">
                                                        <input type="checkbox" class="custom-control-input" id="termsCheckbox" name="term_conditions">
                                                        <label class="custom-control-label" for="termsCheckbox">
                                                            <small>
                                                                <?php echo e(__('By continuing, you agree to the')); ?>

                                                                <a target="_blank" class="link-muted" href="<?php echo e(get_page_url($term_conditions)); ?>"><?php echo e(__('Terms and Conditions')); ?></a>
                                                            </small>
                                                        </label>
                                                    </div>
                                                    <?php if(setting_item("booking_enable_recaptcha")): ?>
                                                        <div class="form-group">
                                                            <?php echo e(recaptcha_field('booking')); ?>

                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="html_before_actions"></div>

                                                <button type="submit" class="btn btn-primary w-100 rounded-sm transition-3d-hover font-size-16 font-weight-bold py-3">
                                                    <?php echo e(__('CONFIRM BOOKING')); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <script>
        $(document).ready(function () {
            $('.has-datetimepicker').daterangepicker({
                singleDatePicker: true,
                timePicker: false,
                showCalendar: false,
                autoUpdateInput: false, //disable default date
                sameDate: true,
                autoApply           : true,
                disabledPast        : true,
                enableLoading       : true,
                showEventTooltip    : true,
                classNotAvailable   : ['disabled', 'off'],
                disableHightLight: true,
                timePicker24Hour: false,
                minDate: new Date(),
                locale:{
                    format:'DD-MM-YYYY'
                }
            }).on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY'));
            });
        })
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ubgmart.com/public_html/etrip/themes/Mytravel/Tour/Views/frontend/blocks/request-tour/index.blade.php ENDPATH**/ ?>