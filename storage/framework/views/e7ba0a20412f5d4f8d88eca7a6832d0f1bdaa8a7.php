<div class="form-group">
    <label><?php echo e(__("Footer Info Contact")); ?></label>
    <div class="form-controls">
        <div id="info_text_editor" class="ace-editor" style="height: 400px" data-theme="textmate" data-mod="html"><?php echo e(setting_item_with_lang('footer_info_text',request()->query('lang'))); ?></div>
        <textarea class="d-none" name="footer_info_text" > <?php echo e(setting_item_with_lang('footer_info_text',request()->query('lang'))); ?> </textarea>
    </div>
</div><?php /**PATH /home/ubgmart.com/public_html/etrip/themes/Mytravel/Core/Views/admin/settings/setting-after-footer.blade.php ENDPATH**/ ?>