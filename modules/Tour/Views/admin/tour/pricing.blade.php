<input type='hidden' value='0' name='enable_deposit'>
<div class="panel">
    <div class="panel-title"><strong>{{__("Pricing")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <h3 class="panel-body-title">{{__("Tour Price")}}</h3>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Price")}}</label>
                        <input type="text" name="price" disabled class="form-control" value="{{$row->price}}" placeholder="{{__("Tour Price")}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Giá Sale</label>
                        <input type="text" name="sale_price" disabled class="form-control" value="{{$row->sale_price}}" placeholder="{{__("Tour Sale Price")}}">
                    </div>
                </div>
                <div class="col-lg-12">
                    <span>
                        {{__("If the regular price is less than the discount , it will show the regular price")}}
                    </span>
                </div>
            </div>
            <hr>
        @endif
        @if(is_default_lang())
            <h3 class="panel-body-title">{{__('Person Types')}}</h3>
            <input type='hidden' value='1' name='enable_person_types'>
            <div class="form-group-item">
                <label class="control-label">{{__('Person Types')}}</label>
                <div class="g-items-header">
                    <div class="row">
                        <div class="col-md-5">{{__("Person Type")}}</div>
                        <div class="col-md-2">{{__('Price')}}</div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="g-items">
                    <?php  $languages = \Modules\Language\Models\Language::getActive(); ?>


                     @if(!empty($row->meta->person_types))
                        @foreach($row->meta->person_types as $key=>$person_type)
                            <div class="item" data-number="{{$key}}">
                                <div class="row">
                                    <div class="col-md-5">
                                        @if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))
                                            @foreach($languages as $language)
                                                <?php $key_lang = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                                <div class="g-lang">
                                                    <div class="title-lang">{{$language->name}}</div>
                                                    <input type="text" name="person_types[{{$key}}][name{{$key_lang}}]" class="form-control" value="{{$person_type['name'.$key_lang] ?? ''}}" placeholder="{{__('Eg: Adults')}}">
                                                    <input type="text" name="person_types[{{$key}}][desc{{$key_lang}}]" class="form-control" value="{{$person_type['desc'.$key_lang] ?? ''}}" placeholder="{{__('Description')}}">
                                                </div>
                                            @endforeach
                                        @else
                                            <input type="text" name="person_types[{{$key}}][name]" class="form-control" value="{{$person_type['name'] ?? ''}}" placeholder="{{__('Eg: Adults')}}">
                                            <input type="text" name="person_types[{{$key}}][desc]" class="form-control" value="{{$person_type['desc'] ?? ''}}" placeholder="{{__('Description')}}">
                                        @endif
                                    </div>
{{--                                    <div class="col-md-2">--}}
{{--                                        <input type="number" min="0" name="person_types[{{$key}}][min]" class="form-control" value="{{$person_type['min'] ?? 0}}" placeholder="{{__("Minimum per booking")}}">--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-2">--}}
{{--                                        <input type="number" min="0" name="person_types[{{$key}}][max]" class="form-control" value="{{$person_type['max'] ?? 0}}" placeholder="{{__("Maximum per booking")}}">--}}
{{--                                    </div>--}}
                                    <div class="col-md-2">
                                        <input type="text" min="0" name="person_types[{{$key}}][price]" class="form-control" value="{{$person_type['price'] ?? 0}}" placeholder="{{__("per 1 item")}}">
                                    </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                         @else
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
                    @endif
                </div>
                <div class="text-right">
                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
                </div>
                <div class="g-more hide">
                    <div class="item" data-number="__number__">
                        <div class="row">
                            <div class="col-md-5">
                                @if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))
                                    @foreach($languages as $language)
                                        <?php $key = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                        <div class="g-lang">
                                            <div class="title-lang">{{$language->name}}</div>
                                            <input type="text" __name__="person_types[__number__][name{{$key}}]" class="form-control" value="" placeholder="{{__('Eg: Adults')}}">
                                            <input type="text" __name__="person_types[__number__][desc{{$key}}]" class="form-control" value="" placeholder="{{__('Description')}}">
                                        </div>
                                    @endforeach
                                @else
                                    <input type="text" __name__="person_types[__number__][name]" class="form-control" value="" placeholder="{{__('Eg: Adults')}}">
                                    <input type="text" __name__="person_types[__number__][desc]" class="form-control" value="" placeholder="{{__('Description')}}">
                                @endif
                            </div>
{{--                            <div class="col-md-2">--}}
{{--                                <input type="number" min="0" __name__="person_types[__number__][min]" class="form-control" value="" placeholder="{{__("Minimum per booking")}}">--}}
{{--                            </div>--}}
{{--                            <div class="col-md-2">--}}
{{--                                <input type="number" min="0" __name__="person_types[__number__][max]" class="form-control" value="" placeholder="{{__("Maximum per booking")}}">--}}
{{--                            </div>--}}
                            <div class="col-md-2">
                                <input type="text" min="0" __name__="person_types[__number__][price]" class="form-control" value="" placeholder="{{__("per 1 item")}}">
                            </div>
                            <div class="col-md-1">
                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(is_default_lang())
            <hr>
            <h3 class="panel-body-title app_get_locale">{{__('Extra Price')}}</h3>
            <div class="form-group app_get_locale">
                <label><input type="checkbox" name="enable_extra_price" @if(!empty($row->meta->enable_extra_price)) checked @endif value="1"> {{__('Enable extra price')}}
                </label>
            </div>
            <div class="form-group-item" data-condition="enable_extra_price:is(1)">
                <label class="control-label">{{__('Extra Price')}}</label>
                <div class="g-items-header">
                    <div class="row">
                        <div class="col-md-5">{{__("Name")}}</div>
                        <div class="col-md-3">{{__('Price')}}</div>
                        <div class="col-md-3">{{__('Type')}}</div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="g-items">
                    @if(!empty($row->meta->extra_price))
                        @foreach($row->meta->extra_price as $key=>$extra_price)
                            <div class="item" data-number="{{$key}}">
                                <div class="row">
                                    <div class="col-md-5">
                                        @if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))
                                            @foreach($languages as $language)
                                                <?php $key_lang = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                                <div class="g-lang">
                                                    <div class="title-lang">{{$language->name}}</div>
                                                    <input type="text" name="extra_price[{{$key}}][name{{$key_lang}}]" class="form-control" value="{{$extra_price['name'.$key_lang] ?? ''}}" placeholder="{{__('Extra price name')}}">
                                                </div>
                                            @endforeach
                                        @else
                                            <input type="text" name="extra_price[{{$key}}][name]" class="form-control" value="{{$extra_price['name'] ?? ''}}" placeholder="{{__('Extra price name')}}">
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" min="0" name="extra_price[{{$key}}][price]" class="form-control" value="{{$extra_price['price']}}">
                                    </div>
                                    <div class="col-md-3">
                                        <select name="extra_price[{{$key}}][type]" class="form-control">
                                            <option @if($extra_price['type'] ==  'one_time') selected @endif value="one_time">{{__("One-time")}}</option>
                                            <option @if($extra_price['type'] ==  'per_hour') selected @endif value="per_hour">{{__("Per hour")}}</option>
                                            <option @if($extra_price['type'] ==  'per_day') selected @endif value="per_day">{{__("Per day")}}</option>
                                        </select>

                                        <label>
                                            <input type="checkbox" min="0" name="extra_price[{{$key}}][per_person]" value="on" @if($extra_price['per_person'] ?? '') checked @endif >
                                            {{__("Price per person")}}
                                        </label>
                                    </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
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
                                        <option value="one_time">{{__("One-time")}}</option>
                                        <option value="per_hour">{{__("Per hour")}}</option>
                                        <option value="per_day">{{__("Per day")}}</option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[0][per_person]" value="on"  >
                                        {{__("Price per person")}}
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
                                        <option value="one_time">{{__("One-time")}}</option>
                                        <option value="per_hour">{{__("Per hour")}}</option>
                                        <option value="per_day">{{__("Per day")}}</option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[1][per_person]" value="on"  >
                                        {{__("Price per person")}}
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
                                        <option value="one_time">{{__("One-time")}}</option>
                                        <option value="per_hour">{{__("Per hour")}}</option>
                                        <option value="per_day">{{__("Per day")}}</option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[2][per_person]" value="on"  >
                                        {{__("Price per person")}}
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
                                        <option value="one_time">{{__("One-time")}}</option>
                                        <option value="per_hour">{{__("Per hour")}}</option>
                                        <option value="per_day">{{__("Per day")}}</option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[3][per_person]" value="on"  >
                                        {{__("Price per person")}}
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
                                        <option value="one_time">{{__("One-time")}}</option>
                                        <option value="per_hour">{{__("Per hour")}}</option>
                                        <option value="per_day">{{__("Per day")}}</option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[4][per_person]" value="on"  >
                                        {{__("Price per person")}}
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
                                        <option value="one_time">{{__("One-time")}}</option>
                                        <option value="per_hour">{{__("Per hour")}}</option>
                                        <option value="per_day">{{__("Per day")}}</option>
                                    </select>

                                    <label>
                                        <input type="checkbox" min="0" name="extra_price[5][per_person]" value="on"  >
                                        {{__("Price per person")}}
                                    </label>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="text-right">
                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
                </div>
                <div class="g-more hide">
                    <div class="item" data-number="__number__">
                        <div class="row">
                            <div class="col-md-5">
                                @if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))
                                    @foreach($languages as $language)
                                        <?php $key = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                        <div class="g-lang">
                                            <div class="title-lang">{{$language->name}}</div>
                                            <input type="text" __name__="extra_price[__number__][name{{$key}}]" class="form-control" value="" placeholder="{{__('Extra price name')}}">
                                        </div>
                                    @endforeach
                                @else
                                    <input type="text" __name__="extra_price[__number__][name]" class="form-control" value="" placeholder="{{__('Extra price name')}}">
                                @endif
                            </div>
                            <div class="col-md-3">
                                <input type="text" min="0" __name__="extra_price[__number__][price]" class="form-control" value="">
                            </div>
                            <div class="col-md-3">
                                <select __name__="extra_price[__number__][type]" class="form-control">
                                    <option value="one_time">{{__("One-time")}}</option>
                                    <option value="per_hour">{{__("Per hour")}}</option>
                                    <option value="per_day">{{__("Per day")}}</option>
                                </select>

                                <label>
                                    <input type="checkbox" min="0" __name__="extra_price[__number__][per_person]" value="on">
                                    {{__("Price per person")}}
                                </label>
                            </div>
                            <div class="col-md-1">
                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(is_default_lang())
                <hr>
                <h3 class="panel-body-title">{{__('Discount by number of people')}}</h3>
                <div class="form-group-item">
                    <div class="g-items-header">
                        <div class="row">
                            <div class="col-md-4">{{__("No of people")}}</div>
                            <div class="col-md-3">{{__('Discount')}}</div>
                            <div class="col-md-3">{{__('Type')}}</div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                    <div class="g-items">
                        @if(!empty($row->meta->discount_by_people))
                            @foreach($row->meta->discount_by_people as $key=>$item)
                                <div class="item" data-number="{{$key}}">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="number" min="0" name="discount_by_people[{{$key}}][from]" class="form-control" value="{{$item['from']}}" placeholder="{{__('From')}}">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" min="0" name="discount_by_people[{{$key}}][to]" class="form-control" value="{{$item['to']}}" placeholder="{{__('To')}}">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" min="0" name="discount_by_people[{{$key}}][amount]" class="form-control" value="{{$item['amount']}}">
                                        </div>
                                        <div class="col-md-3">
                                            <select name="discount_by_people[{{$key}}][type]" class="form-control">
                                                <option @if($item['type'] ==  'fixed') selected @endif value="fixed">{{__("Fixed")}}</option>
                                                <option @if($item['type'] ==  'percent') selected @endif value="percent">{{__("Percent (%)")}}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="text-right">
                        <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
                    </div>
                    <div class="g-more hide">
                        <div class="item" data-number="__number__">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="number" min="0" __name__="discount_by_people[__number__][from]" class="form-control" value="" placeholder="{{__('From')}}">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" min="0" __name__="discount_by_people[__number__][to]" class="form-control" value="" placeholder="{{__('To')}}">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" min="0" __name__="discount_by_people[__number__][amount]" class="form-control" value="">
                                </div>
                                <div class="col-md-3">
                                    <select __name__="discount_by_people[__number__][type]" class="form-control">
                                        <option value="fixed">{{__("Fixed")}}</option>
                                        <option value="percent">{{__("Percent")}}</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        @if(is_default_lang() and (!empty(setting_item("tour_allow_vendor_can_add_service_fee")) or is_admin()))
            <hr>
            <h3 class="panel-body-title app_get_locale">{{__('Service fee')}}</h3>
            <div class="form-group app_get_locale">
                <label><input type="checkbox" name="enable_service_fee" @if(!empty($row->enable_service_fee)) checked @endif value="1"> {{__('Enable service fee')}}
                </label>
            </div>
            <div class="form-group-item" data-condition="enable_service_fee:is(1)">
                <label class="control-label">{{__('Buyer Fees')}}</label>
                <div class="g-items-header">
                    <div class="row">
                        <div class="col-md-5">{{__("Name")}}</div>
                        <div class="col-md-3">{{__('Price')}}</div>
                        <div class="col-md-3">{{__('Type')}}</div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
                <div class="g-items">
                    <?php  $languages = \Modules\Language\Models\Language::getActive();?>
                    @if(!empty($service_fee = $row->service_fee))
                        @foreach($service_fee as $key=>$item)
                            <div class="item" data-number="{{$key}}">
                                <div class="row">
                                    <div class="col-md-5">
                                        @if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))
                                            @foreach($languages as $language)
                                                <?php $key_lang = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                                <div class="g-lang">
                                                    <div class="title-lang">{{$language->name}}</div>
                                                    <input type="text" name="service_fee[{{$key}}][name{{$key_lang}}]" class="form-control" value="{{$item['name'.$key_lang] ?? ''}}" placeholder="{{__('Fee name')}}">
                                                    <input type="text" name="service_fee[{{$key}}][desc{{$key_lang}}]" class="form-control" value="{{$item['desc'.$key_lang] ?? ''}}" placeholder="{{__('Fee desc')}}">
                                                </div>

                                            @endforeach
                                        @else
                                            <input type="text" name="service_fee[{{$key}}][name]" class="form-control" value="{{$item['name'] ?? ''}}" placeholder="{{__('Fee name')}}">
                                            <input type="text" name="service_fee[{{$key}}][desc]" class="form-control" value="{{$item['desc'] ?? ''}}" placeholder="{{__('Fee desc')}}">
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" min="0"  step="0.1"  name="service_fee[{{$key}}][price]" class="form-control" value="{{$item['price'] ?? ""}}">
                                        <select name="service_fee[{{$key}}][unit]" class="form-control">
                                            <option @if(($item['unit'] ?? "") ==  'fixed') selected @endif value="fixed">{{ __("Fixed") }}</option>
                                            <option @if(($item['unit'] ?? "") ==  'percent') selected @endif value="percent">{{ __("Percent") }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="service_fee[{{$key}}][type]" class="form-control d-none">
                                            <option @if($item['type'] ?? "" ==  'one_time') selected @endif value="one_time">{{__("One-time")}}</option>
                                        </select>
                                        <label>
                                            <input type="checkbox" min="0" name="service_fee[{{$key}}][per_person]" value="on" @if($item['per_person'] ?? '') checked @endif >
                                            {{__("Price per person")}}
                                        </label>
                                    </div>
                                    <div class="col-md-1">
                                        <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="text-right">
                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
                </div>
                <div class="g-more hide">
                    <div class="item" data-number="__number__">
                        <div class="row">
                            <div class="col-md-5">
                                @if(!empty($languages) && setting_item('site_enable_multi_lang') && setting_item('site_locale'))
                                    @foreach($languages as $language)
                                        <?php $key = setting_item('site_locale') != $language->locale ? "_".$language->locale : ""   ?>
                                        <div class="g-lang">
                                            <div class="title-lang">{{$language->name}}</div>
                                            <input type="text" __name__="service_fee[__number__][name{{$key}}]" class="form-control" value="" placeholder="{{__('Fee name')}}">
                                            <input type="text" __name__="service_fee[__number__][desc{{$key}}]" class="form-control" value="" placeholder="{{__('Fee desc')}}">
                                        </div>

                                    @endforeach
                                @else
                                    <input type="text" __name__="service_fee[__number__][name]" class="form-control" value="" placeholder="{{__('Fee name')}}">
                                    <input type="text" __name__="service_fee[__number__][desc]" class="form-control" value="" placeholder="{{__('Fee desc')}}">
                                @endif
                            </div>
                            <div class="col-md-3">
                                <input type="number" min="0" step="0.1"  __name__="service_fee[__number__][price]" class="form-control" value="">
                                <select __name__="service_fee[__number__][unit]" class="form-control">
                                    <option value="fixed">{{ __("Fixed") }}</option>
                                    <option value="percent">{{ __("Percent") }}</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select __name__="service_fee[__number__][type]" class="form-control d-none">
                                    <option value="one_time">{{__("One-time")}}</option>
                                </select>
                                <label>
                                    <input type="checkbox" min="0" __name__="service_fee[__number__][per_person]" value="on">
                                    {{__("Price per person")}}
                                </label>
                            </div>
                            <div class="col-md-1">
                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="panel">
        <div class="panel-title"><strong>{{__("Commission Fee")}}</strong></div>
        <div class="panel-body">
            <div class="commission_form">
                @if($row->commission==null)
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
                    @else
                    <div class="row">
                        @php
                            $commission = json_decode($row->commission);
                        @endphp
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">Phí hoa hồng cho người lớn</label>
                                <input type="number"
                                       min="0"
                                       name="commission[adult]"
                                       class="form-control"
                                       value="{{ $commission->adult }}"
                                       placeholder="Ex: 100.000">
                                <i>Phí hoa hồng dành cho mỗi người lớn</i>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">Phí hoa hồng cho trẻ em</label>
                                <input type="number" name="commission[child]" class="form-control" value="{{$commission->child}}" placeholder="Ex: 100.000">
                                <i>Phí hoa hồng dành cho mỗi trẻ em</i>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">Phí hoa hồng cho trẻ nhỏ</label>
                                <input type="number" name="commission[young]" class="form-control" value="{{$commission->young}}" placeholder="Ex: 100.000">
                                <i>Phí hoa hồng dành cho mỗi trẻ nhỏ</i>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">Phí hoa hồng cho em bé</label>
                                <input type="number" name="commission[baby]" class="form-control" value="{{$commission->baby}}" placeholder="Ex: 100.000">
                                <i>Phí hoa hồng dành cho mỗi em bé</i>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
