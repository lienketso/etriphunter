<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("Pricing")); ?></strong></div>
    <div class="panel-body">
        <?php if(is_default_lang()): ?>
            <h3 class="panel-body-title"><?php echo e(__("Tour Price")); ?></h3>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo e(__("Price")); ?></label>
                        <input type="text" name="price" class="form-control" value="<?php echo e($row->price); ?>" placeholder="<?php echo e(__("Tour Price")); ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo e(__("Sale Price")); ?></label>
                        <input type="text" name="sale_price" class="form-control" value="<?php echo e($row->sale_price); ?>" placeholder="<?php echo e(__("Tour Sale Price")); ?>">
                    </div>
                </div>
                <div class="col-lg-12">
                    <span>
                        <?php echo e(__("If the regular price is less than the discount , it will show the regular price")); ?>

                    </span>
                </div>
            </div>
            <hr>
        <?php endif; ?>
        <?php if(is_default_lang()): ?>
            <h3 class="panel-body-title"><?php echo e(__('Person Types')); ?></h3>
            <input type='hidden' value='1' name='enable_person_types'>
            <div class="form-group-item">
                <label class="control-label"><?php echo e(__('Person Types')); ?></label>
                <div class="g-items-header">
                    <div class="row">
                        <div class="col-md-5"><?php echo e(__("Person Type")); ?></div>
                        <div class="col-md-2"><?php echo e(__('Price')); ?></div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="g-items">
                    <?php  $languages = \Modules\Language\Models\Language::getActive(); ?>


                     <?php if(!empty($row->meta->person_types)): ?>
                        <?php $__currentLoopData = $row->meta->person_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$person_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item" data-number="<?php echo e($key); ?>">
                                <div class="row">
                                    <div class="col-md-5">
                                        <?php if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale')): ?>
                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $key_lang = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                                <div class="g-lang">
                                                    <div class="title-lang"><?php echo e($language->name); ?></div>
                                                    <input type="text" name="person_types[<?php echo e($key); ?>][name<?php echo e($key_lang); ?>]" class="form-control" value="<?php echo e($person_type['name'.$key_lang] ?? ''); ?>" placeholder="<?php echo e(__('Eg: Adults')); ?>">
                                                    <input type="text" name="person_types[<?php echo e($key); ?>][desc<?php echo e($key_lang); ?>]" class="form-control" value="<?php echo e($person_type['desc'.$key_lang] ?? ''); ?>" placeholder="<?php echo e(__('Description')); ?>">
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <input type="text" name="person_types[<?php echo e($key); ?>][name]" class="form-control" value="<?php echo e($person_type['name'] ?? ''); ?>" placeholder="<?php echo e(__('Eg: Adults')); ?>">
                                            <input type="text" name="person_types[<?php echo e($key); ?>][desc]" class="form-control" value="<?php echo e($person_type['desc'] ?? ''); ?>" placeholder="<?php echo e(__('Description')); ?>">
                                        <?php endif; ?>
                                    </div>






                                    <div class="col-md-2">
                                        <input type="text" min="0" name="person_types[<?php echo e($key); ?>][price]" class="form-control" value="<?php echo e($person_type['price'] ?? 0); ?>" placeholder="<?php echo e(__("per 1 item")); ?>">
                                    </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php else: ?>
                            <div class="item" data-number="0">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="g-lang">
                                            <div class="title-lang">Tiếng Việt</div>
                                            <input type="text" name="person_types[0][name]" class="form-control" value="Người lớn" >
                                            <input type="text" name="person_types[0][desc]" class="form-control" value="Trên 12 tuổi" >
                                        </div>
                                        <div class="g-lang">
                                            <div class="title-lang">English</div>
                                            <input type="text" name="person_types[0][name_en]" class="form-control" value="Adult" placeholder="Eg: Adults">
                                            <input type="text" name="person_types[0][desc_en]" class="form-control" value="Age >12" placeholder="Description">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" min="0" name="person_types[0][price]" class="form-control" value="0" placeholder="per 1 item">
                                    </div>
                                </div>
                            </div>
                            <div class="item" data-number="1">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="g-lang">
                                            <div class="title-lang">Tiếng Việt</div>
                                            <input type="text" name="person_types[1][name]" class="form-control" value="Trẻ em" >
                                            <input type="text" name="person_types[1][desc]" class="form-control" value="Tuổi từ 6-11" >
                                        </div>
                                        <div class="g-lang">
                                            <div class="title-lang">English</div>
                                            <input type="text" name="person_types[1][name_en]" class="form-control" value="Child" >
                                            <input type="text" name="person_types[1][desc_en]" class="form-control" value="Age 6 - 11">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" min="0" name="person_types[1][price]" class="form-control" value="0" placeholder="per 1 item">
                                    </div>
                                </div>
                            </div>
                            <div class="item" data-number="2">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="g-lang">
                                            <div class="title-lang">Tiếng Việt</div>
                                            <input type="text" name="person_types[2][name]" class="form-control" value="Trẻ nhỏ" >
                                            <input type="text" name="person_types[2][desc]" class="form-control" value="Tuổi từ 2-5" >
                                        </div>
                                        <div class="g-lang">
                                            <div class="title-lang">English</div>
                                            <input type="text" name="person_types[2][name_en]" class="form-control" value="Young" placeholder="Eg: Adults">
                                            <input type="text" name="person_types[2][desc_en]" class="form-control" value="Age 2 - 5" placeholder="Description">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" min="0" name="person_types[2][price]" class="form-control" value="0" placeholder="per 1 item">
                                    </div>
                                </div>
                            </div>
                            <div class="item" data-number="3">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="g-lang">
                                            <div class="title-lang">Tiếng Việt</div>
                                            <input type="text" name="person_types[3][name]" class="form-control" value="Em bé" >
                                            <input type="text" name="person_types[3][desc]" class="form-control" value="Dưới 2 tuổi" >
                                        </div>
                                        <div class="g-lang">
                                            <div class="title-lang">English</div>
                                            <input type="text" name="person_types[3][name_en]" class="form-control" value="Child" >
                                            <input type="text" name="person_types[3][desc_en]" class="form-control" value="Age <2" >
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" min="0" name="person_types[3][price]" class="form-control" value="0" placeholder="per 1 item">
                                    </div>
                                </div>
                            </div>
                    <?php endif; ?>
                </div>
                <div class="text-right">
                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> <?php echo e(__('Add item')); ?></span>
                </div>
                <div class="g-more hide">
                    <div class="item" data-number="__number__">
                        <div class="row">
                            <div class="col-md-5">
                                <?php if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale')): ?>
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $key = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                        <div class="g-lang">
                                            <div class="title-lang"><?php echo e($language->name); ?></div>
                                            <input type="text" __name__="person_types[__number__][name<?php echo e($key); ?>]" class="form-control" value="" placeholder="<?php echo e(__('Eg: Adults')); ?>">
                                            <input type="text" __name__="person_types[__number__][desc<?php echo e($key); ?>]" class="form-control" value="" placeholder="<?php echo e(__('Description')); ?>">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <input type="text" __name__="person_types[__number__][name]" class="form-control" value="" placeholder="<?php echo e(__('Eg: Adults')); ?>">
                                    <input type="text" __name__="person_types[__number__][desc]" class="form-control" value="" placeholder="<?php echo e(__('Description')); ?>">
                                <?php endif; ?>
                            </div>






                            <div class="col-md-2">
                                <input type="text" min="0" __name__="person_types[__number__][price]" class="form-control" value="" placeholder="<?php echo e(__("per 1 item")); ?>">
                            </div>
                            <div class="col-md-1">
                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(is_default_lang()): ?>
            <hr>
            <h3 class="panel-body-title app_get_locale"><?php echo e(__('Extra Price')); ?></h3>
            <div class="form-group app_get_locale">
                <label><input type="checkbox" name="enable_extra_price" <?php if(!empty($row->meta->enable_extra_price)): ?> checked <?php endif; ?> value="1"> <?php echo e(__('Enable extra price')); ?>

                </label>
            </div>
            <div class="form-group-item" data-condition="enable_extra_price:is(1)">
                <label class="control-label"><?php echo e(__('Extra Price')); ?></label>
                <div class="g-items-header">
                    <div class="row">
                        <div class="col-md-5"><?php echo e(__("Name")); ?></div>
                        <div class="col-md-3"><?php echo e(__('Price')); ?></div>
                        <div class="col-md-3"><?php echo e(__('Type')); ?></div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="g-items">
                    <?php if(!empty($row->meta->extra_price)): ?>
                        <?php $__currentLoopData = $row->meta->extra_price; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$extra_price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item" data-number="<?php echo e($key); ?>">
                                <div class="row">
                                    <div class="col-md-5">
                                        <?php if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale')): ?>
                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $key_lang = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                                <div class="g-lang">
                                                    <div class="title-lang"><?php echo e($language->name); ?></div>
                                                    <input type="text" name="extra_price[<?php echo e($key); ?>][name<?php echo e($key_lang); ?>]" class="form-control" value="<?php echo e($extra_price['name'.$key_lang] ?? ''); ?>" placeholder="<?php echo e(__('Extra price name')); ?>">
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <input type="text" name="extra_price[<?php echo e($key); ?>][name]" class="form-control" value="<?php echo e($extra_price['name'] ?? ''); ?>" placeholder="<?php echo e(__('Extra price name')); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" min="0" name="extra_price[<?php echo e($key); ?>][price]" class="form-control" value="<?php echo e($extra_price['price']); ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <select name="extra_price[<?php echo e($key); ?>][type]" class="form-control">
                                            <option <?php if($extra_price['type'] ==  'one_time'): ?> selected <?php endif; ?> value="one_time"><?php echo e(__("One-time")); ?></option>
                                            <option <?php if($extra_price['type'] ==  'per_hour'): ?> selected <?php endif; ?> value="per_hour"><?php echo e(__("Per hour")); ?></option>
                                            <option <?php if($extra_price['type'] ==  'per_day'): ?> selected <?php endif; ?> value="per_day"><?php echo e(__("Per day")); ?></option>
                                        </select>

                                        <label>
                                            <input type="checkbox" min="0" name="extra_price[<?php echo e($key); ?>][per_person]" value="on" <?php if($extra_price['per_person'] ?? ''): ?> checked <?php endif; ?> >
                                            <?php echo e(__("Price per person")); ?>

                                        </label>
                                    </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <div class="item" data-number="0">
                            <div class="row">
                                <div class="col-md-5">
                                            <div class="g-lang">
                                                <div class="title-lang">Tiếng Việt</div>
                                                <input type="text" name="extra_price[0][name]" class="form-control" value="Khách sạn 3*" placeholder="Khách sạn 3*">
                                            </div>
                                            <div class="g-lang">
                                                <div class="title-lang">Tiếng Anh</div>
                                                <input type="text" name="extra_price[0][name_en]" class="form-control" value="Hotel 3*" placeholder="Hotel 3*">
                                            </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" min="0" name="extra_price[0][price]" class="form-control" value="0">
                                </div>
                                <div class="col-md-3">
                                    <select name="extra_price[0][type]" class="form-control">
                                        <option value="one_time"><?php echo e(__("One-time")); ?></option>
                                        <option value="per_hour"><?php echo e(__("Per hour")); ?></option>
                                        <option value="per_day"><?php echo e(__("Per day")); ?></option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[0][per_person]" value="on"  >
                                        <?php echo e(__("Price per person")); ?>

                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="item" data-number="1">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="g-lang">
                                        <div class="title-lang">Tiếng Việt</div>
                                        <input type="text" name="extra_price[1][name]" class="form-control" value="Khách sạn 4*" placeholder="Khách sạn 4*">
                                    </div>
                                    <div class="g-lang">
                                        <div class="title-lang">Tiếng Anh</div>
                                        <input type="text" name="extra_price[1][name_en]" class="form-control" value="Hotel 4*" placeholder="Hotel 4*">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" min="0" name="extra_price[1][price]" class="form-control" value="0">
                                </div>
                                <div class="col-md-3">
                                    <select name="extra_price[1][type]" class="form-control">
                                        <option value="one_time"><?php echo e(__("One-time")); ?></option>
                                        <option value="per_hour"><?php echo e(__("Per hour")); ?></option>
                                        <option value="per_day"><?php echo e(__("Per day")); ?></option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[1][per_person]" value="on"  >
                                        <?php echo e(__("Price per person")); ?>

                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="item" data-number="2">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="g-lang">
                                        <div class="title-lang">Tiếng Việt</div>
                                        <input type="text" name="extra_price[2][name]" class="form-control" value="Khách sạn 5*" placeholder="Khách sạn 5*">
                                    </div>
                                    <div class="g-lang">
                                        <div class="title-lang">Tiếng Anh</div>
                                        <input type="text" name="extra_price[2][name_en]" class="form-control" value="Hotel 5*" placeholder="Hotel 5*">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" min="0" name="extra_price[2][price]" class="form-control" value="0">
                                </div>
                                <div class="col-md-3">
                                    <select name="extra_price[2][type]" class="form-control">
                                        <option value="one_time"><?php echo e(__("One-time")); ?></option>
                                        <option value="per_hour"><?php echo e(__("Per hour")); ?></option>
                                        <option value="per_day"><?php echo e(__("Per day")); ?></option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[2][per_person]" value="on"  >
                                        <?php echo e(__("Price per person")); ?>

                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="item" data-number="3">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="g-lang">
                                        <div class="title-lang">Tiếng Việt</div>
                                        <input type="text" name="extra_price[3][name]" class="form-control" value="Máy bay" placeholder="Phương tiện máy bay">
                                    </div>
                                    <div class="g-lang">
                                        <div class="title-lang">Tiếng Anh</div>
                                        <input type="text" name="extra_price[3][name_en]" class="form-control" value="Airplane" placeholder="Airplane">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" min="0" name="extra_price[3][price]" class="form-control" value="0">
                                </div>
                                <div class="col-md-3">
                                    <select name="extra_price[3][type]" class="form-control">
                                        <option value="one_time"><?php echo e(__("One-time")); ?></option>
                                        <option value="per_hour"><?php echo e(__("Per hour")); ?></option>
                                        <option value="per_day"><?php echo e(__("Per day")); ?></option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[3][per_person]" value="on"  >
                                        <?php echo e(__("Price per person")); ?>

                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="item" data-number="4">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="g-lang">
                                        <div class="title-lang">Tiếng Việt</div>
                                        <input type="text" name="extra_price[4][name]" class="form-control" value="Ô tô" placeholder="Phương tiện ô tô">
                                    </div>
                                    <div class="g-lang">
                                        <div class="title-lang">Tiếng Anh</div>
                                        <input type="text" name="extra_price[4][name_en]" class="form-control" value="Car" placeholder="Transport by car">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" min="0" name="extra_price[4][price]" class="form-control" value="0">
                                </div>
                                <div class="col-md-3">
                                    <select name="extra_price[4][type]" class="form-control">
                                        <option value="one_time"><?php echo e(__("One-time")); ?></option>
                                        <option value="per_hour"><?php echo e(__("Per hour")); ?></option>
                                        <option value="per_day"><?php echo e(__("Per day")); ?></option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[4][per_person]" value="on"  >
                                        <?php echo e(__("Price per person")); ?>

                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="item" data-number="5">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="g-lang">
                                        <div class="title-lang">Tiếng Việt</div>
                                        <input type="text" name="extra_price[5][name]" class="form-control" value="Tầu hỏa" placeholder="Phương tiện tầu hỏa">
                                    </div>
                                    <div class="g-lang">
                                        <div class="title-lang">Tiếng Anh</div>
                                        <input type="text" name="extra_price[5][name_en]" class="form-control" value="Train" placeholder="Transport by train">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" min="0" name="extra_price[5][price]" class="form-control" value="0">
                                </div>
                                <div class="col-md-3">
                                    <select name="extra_price[5][type]" class="form-control">
                                        <option value="one_time"><?php echo e(__("One-time")); ?></option>
                                        <option value="per_hour"><?php echo e(__("Per hour")); ?></option>
                                        <option value="per_day"><?php echo e(__("Per day")); ?></option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[5][per_person]" value="on"  >
                                        <?php echo e(__("Price per person")); ?>

                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="text-right">
                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> <?php echo e(__('Add item')); ?></span>
                </div>
                <div class="g-more hide">
                    <div class="item" data-number="__number__">
                        <div class="row">
                            <div class="col-md-5">
                                <?php if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale')): ?>
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $key = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                        <div class="g-lang">
                                            <div class="title-lang"><?php echo e($language->name); ?></div>
                                            <input type="text" __name__="extra_price[__number__][name<?php echo e($key); ?>]" class="form-control" value="" placeholder="<?php echo e(__('Extra price name')); ?>">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <input type="text" __name__="extra_price[__number__][name]" class="form-control" value="" placeholder="<?php echo e(__('Extra price name')); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="col-md-3">
                                <input type="text" min="0" __name__="extra_price[__number__][price]" class="form-control" value="">
                            </div>
                            <div class="col-md-3">
                                <select __name__="extra_price[__number__][type]" class="form-control">
                                    <option value="one_time"><?php echo e(__("One-time")); ?></option>
                                    <option value="per_hour"><?php echo e(__("Per hour")); ?></option>
                                    <option value="per_day"><?php echo e(__("Per day")); ?></option>
                                </select>

                                <label>
                                    <input type="checkbox" min="0" __name__="extra_price[__number__][per_person]" value="on">
                                    <?php echo e(__("Price per person")); ?>

                                </label>
                            </div>
                            <div class="col-md-1">
                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(is_default_lang()): ?>
                <hr>
                <h3 class="panel-body-title"><?php echo e(__('Discount by number of people')); ?></h3>
                <div class="form-group-item">
                    <div class="g-items-header">
                        <div class="row">
                            <div class="col-md-4"><?php echo e(__("No of people")); ?></div>
                            <div class="col-md-3"><?php echo e(__('Discount')); ?></div>
                            <div class="col-md-3"><?php echo e(__('Type')); ?></div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                    <div class="g-items">
                        <?php if(!empty($row->meta->discount_by_people)): ?>
                            <?php $__currentLoopData = $row->meta->discount_by_people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item" data-number="<?php echo e($key); ?>">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="number" min="0" name="discount_by_people[<?php echo e($key); ?>][from]" class="form-control" value="<?php echo e($item['from']); ?>" placeholder="<?php echo e(__('From')); ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" min="0" name="discount_by_people[<?php echo e($key); ?>][to]" class="form-control" value="<?php echo e($item['to']); ?>" placeholder="<?php echo e(__('To')); ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" min="0" name="discount_by_people[<?php echo e($key); ?>][amount]" class="form-control" value="<?php echo e($item['amount']); ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <select name="discount_by_people[<?php echo e($key); ?>][type]" class="form-control">
                                                <option <?php if($item['type'] ==  'fixed'): ?> selected <?php endif; ?> value="fixed"><?php echo e(__("Fixed")); ?></option>
                                                <option <?php if($item['type'] ==  'percent'): ?> selected <?php endif; ?> value="percent"><?php echo e(__("Percent (%)")); ?></option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                    <div class="text-right">
                        <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> <?php echo e(__('Add item')); ?></span>
                    </div>
                    <div class="g-more hide">
                        <div class="item" data-number="__number__">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="number" min="0" __name__="discount_by_people[__number__][from]" class="form-control" value="" placeholder="<?php echo e(__('From')); ?>">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" __name__="discount_by_people[__number__][to]" class="form-control" value="" placeholder="<?php echo e(__('To')); ?>">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0" __name__="discount_by_people[__number__][amount]" class="form-control" value="">
                                </div>
                                <div class="col-md-3">
                                    <select __name__="discount_by_people[__number__][type]" class="form-control">
                                        <option value="fixed"><?php echo e(__("Fixed")); ?></option>
                                        <option value="percent"><?php echo e(__("Percent")); ?></option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        <?php if(is_default_lang() and (!empty(setting_item("tour_allow_vendor_can_add_service_fee")) or is_admin())): ?>
            <hr>
            <h3 class="panel-body-title app_get_locale"><?php echo e(__('Service fee')); ?></h3>
            <div class="form-group app_get_locale">
                <label><input type="checkbox" name="enable_service_fee" <?php if(!empty($row->enable_service_fee)): ?> checked <?php endif; ?> value="1"> <?php echo e(__('Enable service fee')); ?>

                </label>
            </div>
            <div class="form-group-item" data-condition="enable_service_fee:is(1)">
                <label class="control-label"><?php echo e(__('Buyer Fees')); ?></label>
                <div class="g-items-header">
                    <div class="row">
                        <div class="col-md-5"><?php echo e(__("Name")); ?></div>
                        <div class="col-md-3"><?php echo e(__('Price')); ?></div>
                        <div class="col-md-3"><?php echo e(__('Type')); ?></div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="g-items">
                    <?php  $languages = \Modules\Language\Models\Language::getActive();?>
                    <?php if(!empty($service_fee = $row->service_fee)): ?>
                        <?php $__currentLoopData = $service_fee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item" data-number="<?php echo e($key); ?>">
                                <div class="row">
                                    <div class="col-md-5">
                                        <?php if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale')): ?>
                                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $key_lang = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                                <div class="g-lang">
                                                    <div class="title-lang"><?php echo e($language->name); ?></div>
                                                    <input type="text" name="service_fee[<?php echo e($key); ?>][name<?php echo e($key_lang); ?>]" class="form-control" value="<?php echo e($item['name'.$key_lang] ?? ''); ?>" placeholder="<?php echo e(__('Fee name')); ?>">
                                                    <input type="text" name="service_fee[<?php echo e($key); ?>][desc<?php echo e($key_lang); ?>]" class="form-control" value="<?php echo e($item['desc'.$key_lang] ?? ''); ?>" placeholder="<?php echo e(__('Fee desc')); ?>">
                                                </div>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <input type="text" name="service_fee[<?php echo e($key); ?>][name]" class="form-control" value="<?php echo e($item['name'] ?? ''); ?>" placeholder="<?php echo e(__('Fee name')); ?>">
                                            <input type="text" name="service_fee[<?php echo e($key); ?>][desc]" class="form-control" value="<?php echo e($item['desc'] ?? ''); ?>" placeholder="<?php echo e(__('Fee desc')); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" min="0"  step="0.1"  name="service_fee[<?php echo e($key); ?>][price]" class="form-control" value="<?php echo e($item['price'] ?? ""); ?>">
                                        <select name="service_fee[<?php echo e($key); ?>][unit]" class="form-control">
                                            <option <?php if(($item['unit'] ?? "") ==  'fixed'): ?> selected <?php endif; ?> value="fixed"><?php echo e(__("Fixed")); ?></option>
                                            <option <?php if(($item['unit'] ?? "") ==  'percent'): ?> selected <?php endif; ?> value="percent"><?php echo e(__("Percent")); ?></option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="service_fee[<?php echo e($key); ?>][type]" class="form-control d-none">
                                            <option <?php if($item['type'] ?? "" ==  'one_time'): ?> selected <?php endif; ?> value="one_time"><?php echo e(__("One-time")); ?></option>
                                        </select>
                                        <label>
                                            <input type="checkbox" min="0" name="service_fee[<?php echo e($key); ?>][per_person]" value="on" <?php if($item['per_person'] ?? ''): ?> checked <?php endif; ?> >
                                            <?php echo e(__("Price per person")); ?>

                                        </label>
                                    </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
                <div class="text-right">
                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> <?php echo e(__('Add item')); ?></span>
                </div>
                <div class="g-more hide">
                    <div class="item" data-number="__number__">
                        <div class="row">
                            <div class="col-md-5">
                                <?php if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale')): ?>
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $key = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                        <div class="g-lang">
                                            <div class="title-lang"><?php echo e($language->name); ?></div>
                                            <input type="text" __name__="service_fee[__number__][name<?php echo e($key); ?>]" class="form-control" value="" placeholder="<?php echo e(__('Fee name')); ?>">
                                            <input type="text" __name__="service_fee[__number__][desc<?php echo e($key); ?>]" class="form-control" value="" placeholder="<?php echo e(__('Fee desc')); ?>">
                                        </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <input type="text" __name__="service_fee[__number__][name]" class="form-control" value="" placeholder="<?php echo e(__('Fee name')); ?>">
                                    <input type="text" __name__="service_fee[__number__][desc]" class="form-control" value="" placeholder="<?php echo e(__('Fee desc')); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="col-md-3">
                                <input type="number" min="0" step="0.1"  __name__="service_fee[__number__][price]" class="form-control" value="">
                                <select __name__="service_fee[__number__][unit]" class="form-control">
                                    <option value="fixed"><?php echo e(__("Fixed")); ?></option>
                                    <option value="percent"><?php echo e(__("Percent")); ?></option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select __name__="service_fee[__number__][type]" class="form-control d-none">
                                    <option value="one_time"><?php echo e(__("One-time")); ?></option>
                                </select>
                                <label>
                                    <input type="checkbox" min="0" __name__="service_fee[__number__][per_person]" value="on">
                                    <?php echo e(__("Price per person")); ?>

                                </label>
                            </div>
                            <div class="col-md-1">
                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
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
                                <input type="number"
                                       min="0"
                                       name="commission[adult]"
                                       class="form-control"
                                       value="<?php echo e($commission->adult); ?>"
                                       placeholder="Ex: 100.000">
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

</div>
<?php /**PATH C:\laragon\www\etrip\modules/Tour/Views/admin/tour/pricing.blade.php ENDPATH**/ ?>