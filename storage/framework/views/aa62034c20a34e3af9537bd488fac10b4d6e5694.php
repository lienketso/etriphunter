<?php if(is_default_lang()): ?>
    <div class="form-group">
        <label><?php echo e(__("Logo Color")); ?></label>
        <div class="form-controls form-group-image">
            <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('logo_id_2',setting_item('logo_id_2')); ?>

        </div>
    </div>
<?php endif; ?>
<div class="form-group">
    <label><?php echo e(__("Logo Text")); ?></label>
    <div class="form-controls">
        <input type="text" class="form-control" name="logo_text" value="<?php echo e(setting_item_with_lang('logo_text',request()->query('lang'))); ?>">
    </div>
</div><?php /**PATH /home/ubgmart.com/public_html/etrip/themes/Mytravel/Core/Views/admin/settings/setting-after-logo.blade.php ENDPATH**/ ?>