<?php
    $terms_ids = $row->tour_term->pluck('term_id');
    $attributes = \Modules\Core\Models\Terms::getTermsById($terms_ids);
?>
<?php if(!empty($terms_ids) and !empty($attributes)): ?>
    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $translate_attribute = $attribute['parent']->translateOrOrigin(app()->getLocale()) ?>
        <?php if(empty($attribute['parent']['hide_in_single'])): ?>
            <div class="g-attributes mb-4 <?php echo e($attribute['parent']->slug); ?> attr-<?php echo e($attribute['parent']->id); ?>">
                <h3 class="font-size-16"><?php echo e($translate_attribute->name); ?></h3>
                <?php $terms = $attribute['child'] ?>
                <div class="list-attributes">
                    <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $translate_term = $term->translateOrOrigin(app()->getLocale()) ?>
                        <div class="item <?php echo e($term->slug); ?> term-<?php echo e($term->id); ?>">
                            <?php if(!empty($term->image_id)): ?>
                                <?php $image_url = get_file_url($term->image_id, 'full'); ?>
                                <img src="<?php echo e($image_url); ?>" class="img-responsive" alt="<?php echo e($translate_term->name); ?>">
                            <?php else: ?>
                                <i class="<?php echo e($term->icon ?? "icofont-check-circled icon-default text-primary"); ?>"></i>
                            <?php endif; ?>
                            <?php echo e($translate_term->name); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\etrip\themes/Mytravel/Tour/Views/frontend/layouts/details/tour-attributes.blade.php ENDPATH**/ ?>