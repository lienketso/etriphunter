<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Commission Fee")); ?></strong></div>
    <div class="panel-body">
        <div class="commission_form">
            <?php if($row->commission==null): ?>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="control-label">Phí hoa hồng cho người lớn</label>
                            <input type="number"
                                   name="commission[adult]"
                                   min="0"
                                   class="form-control"
                                   value="0"
                                   placeholder="Ex: 100.000">
                            <i>Phí hoa hồng dành cho mỗi người lớn</i>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="control-label">Phí hoa hồng cho trẻ em</label>
                            <input type="number"
                                   name="commission[child]"
                                   min="0"
                                   class="form-control"
                                   value="0"
                                   placeholder="Ex: 100.000">
                            <i>Phí hoa hồng dành cho mỗi trẻ em</i>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="control-label">Phí hoa hồng cho trẻ nhỏ</label>
                            <input type="number"
                                   name="commission[young]"
                                   min="0"
                                   class="form-control"
                                   value="0"
                                   placeholder="Ex: 100.000">
                            <i>Phí hoa hồng dành cho mỗi trẻ nhỏ</i>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="control-label">Phí hoa hồng cho em bé</label>
                            <input type="number"
                                   name="commission[baby]"
                                   min="0"
                                   class="form-control"
                                   value="0"
                                   placeholder="Ex: 100.000">
                            <i>Phí hoa hồng dành cho mỗi em bé</i>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php
                        $commission = json_decode($row->commission);
                    ?>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="control-label">Phí hoa hồng cho người lớn</label>
                            <input type="number" name="commission[adult]" class="form-control" value="<?php echo e($commission->adult); ?>" placeholder="Ex: 100.000">
                            <i>Phí hoa hồng dành cho mỗi người lớn</i>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="control-label">Phí hoa hồng cho trẻ em</label>
                            <input type="number" name="commission[child]" class="form-control" value="<?php echo e($commission->child); ?>" placeholder="Ex: 100.000">
                            <i>Phí hoa hồng dành cho mỗi trẻ em</i>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="control-label">Phí hoa hồng cho trẻ nhỏ</label>
                            <input type="number" name="commission[young]" class="form-control" value="<?php echo e($commission->young); ?>" placeholder="Ex: 100.000">
                            <i>Phí hoa hồng dành cho mỗi trẻ nhỏ</i>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="control-label">Phí hoa hồng cho em bé</label>
                            <input type="number" name="commission[baby]" class="form-control" value="<?php echo e($commission->baby); ?>" placeholder="Ex: 100.000">
                            <i>Phí hoa hồng dành cho mỗi em bé</i>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /home/ubgmart.com/public_html/etrip/modules/Car/Views/admin/car/commission.blade.php ENDPATH**/ ?>