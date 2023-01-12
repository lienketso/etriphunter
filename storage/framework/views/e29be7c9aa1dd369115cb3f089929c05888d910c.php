<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Tour Content")); ?></strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label><?php echo e(__("Title")); ?></label>
            <input type="text" value="<?php echo clean($translation->title); ?>" placeholder="<?php echo e(__("Tour title")); ?>" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Content")); ?></label>
            <div class="">
                <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e($translation->content); ?></textarea>
            </div>
        </div>
        <div class="form-group d-none">
            <label class="control-label"><?php echo e(__("Description")); ?></label>
            <div class="">
                <textarea name="short_desc" class="form-control" cols="30" rows="4"><?php echo e($translation->short_desc); ?></textarea>
            </div>
        </div>
        <?php if(is_default_lang()): ?>
            <div class="form-group">
                <label class="control-label"><?php echo e(__("Category")); ?></label>
                <div class="">
                    <select name="category_id" class="form-control">
                        <option value=""><?php echo e(__("-- Please Select --")); ?></option>
                        <?php
                        $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
                            foreach ($categories as $category) {
                                $selected = '';
                                if ($row->category_id == $category->id)
                                    $selected = 'selected';
                                printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                                $traverse($category->children, $prefix . '-');
                            }
                        };
                        $traverse($tour_category);
                        ?>
                    </select>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo e(__("Slots")); ?></label>
                        <input type="number" name="max_people" class="form-control" min="0" value="<?php echo e($row->max_people); ?>" placeholder="<?php echo e(__("Ex: 3")); ?>">
                        <i>Số chỗ còn nhận</i>
                    </div>
                </div>









                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo e(__("Ngày khởi hành")); ?></label>
                        <input type="text" name="departure_day" class="form-control has-datetimepicker"
                               value="<?php echo e(!is_null($row->departure_day) ? showVNdate($row->departure_day) : ''); ?>"
                               placeholder="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo e(__("Youtube Video")); ?></label>
                        <input type="text" name="video" class="form-control" value="<?php echo e($row->video); ?>" placeholder="<?php echo e(__("Youtube link video")); ?>">
                    </div>
                </div>
            </div>

            <?php if(is_default_lang()): ?>
                <div class="row">


















                </div>
            <?php endif; ?>
















        <?php endif; ?>
<!--        <?php //do_action(\Modules\Tour\Hook::FORM_AFTER_MAX_PEOPLE,$row) ?> -->
















































        <?php echo $__env->make('Tour::admin/tour/include-exclude', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('Tour::admin/tour/itinerary-text', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php if(is_default_lang()): ?>
            <div class="form-group">
                <label class="control-label"><?php echo e(__("Banner Image")); ?></label>
                <div class="form-group-image">
                    <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',$row->banner_image_id); ?>

                </div>
            </div>
            <div class="form-group">
                <label class="control-label"><?php echo e(__("Gallery")); ?></label>
                <?php echo \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery); ?>

            </div>
        <?php endif; ?>
    </div>
</div>

<?php /**PATH C:\laragon\www\etrip\modules/Tour/Views/admin/tour/tour-content.blade.php ENDPATH**/ ?>