<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Tour Locations")); ?></strong></div>
    <div class="panel-body">
        <?php if(is_default_lang()): ?>
            <div class="form-group">
                <label class="control-label"><?php echo e(__("Starting Location")); ?></label>
                <div class="">
                    <select name="start_location_id" class="form-control">
                        <option value=""><?php echo e(__("-- Please Select --")); ?></option>
                        <?php
                        $traverse = function ($locations, $prefix = '') use (&$traverse, $row) {
                            foreach ($locations as $location) {
                                $selected = '';
                                if ($row->start_location_id == $location->id)
                                    $selected = 'selected';
                                printf("<option value='%s' %s>%s</option>", $location->id, $selected, $prefix . ' ' . $location->name);
                                $traverse($location->children, $prefix . '-');
                            }
                        };
                        $traverse($tour_location);
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label"><?php echo e(__("Destination")); ?></label>
                
                    <div class="">
                        <select name="location_id" class="form-control">
                            <option value=""><?php echo e(__("-- Please Select --")); ?></option>
                            <?php
                            $traverse = function ($locations, $prefix = '') use (&$traverse, $row) {
                                foreach ($locations as $location) {
                                    $selected = '';
                                    if ($row->location_id == $location->id)
                                        $selected = 'selected';
                                    printf("<option value='%s' %s>%s</option>", $location->id, $selected, $prefix . ' ' . $location->name);
                                    $traverse($location->children, $prefix . '-');
                                }
                            };
                            $traverse($tour_location);
                            ?>
                        </select>
                    </div>


            </div>
        <?php endif; ?>
        <div class="form-group">
            <label class="control-label"><?php echo e(__("Real tour address")); ?></label>
            <input type="text" name="address" id="customPlaceAddress" class="form-control" placeholder="<?php echo e(__("Real tour address")); ?>" value="<?php echo e($translation->address); ?>">
        </div>
            <div class="form-group">
                <label class="control-label">Nhiều điểm đến</label>
                <select multiple class="form-control dungdt-select2-field" name="muti_location[]">
                        <?php
                                $traverse = function ($locations, $prefix = '') use (&$traverse, $row,$arrLocation) {
                                    foreach ($locations as $location) {
                                        $selected = '';
                                        if (in_array($location->id,$arrLocation))
                                            $selected = 'selected';
                                        printf("<option value='%s' %s>%s</option>", $location->id, $selected, $prefix . ' ' . $location->name);
                                        $traverse($location->children, $prefix . '-');
                                    }
                                };
                                $traverse($tour_location);
                            ?>
                </select>
            </div>
        
    </div>
</div>
<?php /**PATH C:\laragon\www\etrip\modules/Tour/Views/admin/tour/tour-location.blade.php ENDPATH**/ ?>