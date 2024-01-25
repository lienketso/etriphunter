<div class="panel">
    <div class="panel-title"><strong>{{__("Tour Content")}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label>{{__("Title")}}</label>
            <input type="text" value="{!! clean($translation->title) !!}" placeholder="{{__("Tour title")}}" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Mã sản phẩm</label>
            <input type="text" value="{!! $row->tour_code !!}" placeholder="Mã sản phẩm" name="tour_code" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label">{{__("Content")}}</label>
            <div class="">
                <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>
            </div>
        </div>
        <div class="form-group d-none">
            <label class="control-label">{{__("Description")}}</label>
            <div class="">
                <textarea name="short_desc" class="form-control" cols="30" rows="4">{{$translation->short_desc}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Điều kiện hoàn hủy</label>
            <div class="">
                <textarea name="cancel_rules" class="d-none has-ckeditor" cols="30" rows="10">{{$row->cancel_rules}}</textarea>
            </div>
        </div>
        @if(is_default_lang())
            <div class="form-group">
                <label class="control-label">{{__("Category")}}</label>
                <div class="">
                    <select name="category_id" class="form-control" id="category_id">
                        <option value="">{{__("-- Please Select --")}}</option>
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
                        <label class="control-label">{{__("Slots")}}</label>
                        <input type="number" name="max_people" class="form-control" min="0" value="{{($row->max_people) ? $row->max_people : 0}}" placeholder="{{__("Ex: 3")}}">
                        <i>Số chỗ còn nhận</i>
                    </div>
                </div>
{{--                <div class="col-lg-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="control-label">Số ngày tour</label>--}}
{{--                        <div class="input-group mb-3">--}}
{{--                            <input type="number" name="number_of_days" class="form-control" min="0" value="{{$row->number_of_days}}"--}}
{{--                                   placeholder="{{__("Số ngày tour")}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Ngày khởi hành")}}</label>
                        <input type="text" name="departure_day" class="form-control has-datetimepicker"
                               value="{{ !is_null($row->departure_day) ? showVNdate($row->departure_day) : '' }}"
                               placeholder="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">{{__("Youtube Video")}}</label>
                        <input type="text" name="video" class="form-control" value="{{$row->video}}" placeholder="{{__("Youtube link video")}}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Số ngày sẽ gửi mail nhắc khách hàng: </label>
                        <input type="number" name="remind_number_date" class="form-control" value="{{$row->remind_number_date}}" placeholder="{{__("Số ngày sẽ gửi mail nhắc khách hàng")}}" min="1" max="10">
                    </div>
                </div>
            </div>

            @if(is_default_lang())
                <div class="row">
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="control-label">{{__("Minimum advance reservations")}}</label>--}}
{{--                            <input type="number" name="min_day_before_booking" class="form-control" value="{{$row->min_day_before_booking}}" placeholder="{{__("Ex: 3")}}">--}}
{{--                            <i>{{ __("Leave blank if you dont need to use the min day option") }}</i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="control-label">{{__("Duration")}}</label>--}}
{{--                            <div class="input-group mb-3">--}}
{{--                                <input type="text" name="duration" class="form-control" value="{{$row->duration}}" placeholder="{{__("Duration")}}"  aria-describedby="basic-addon2">--}}
{{--                                <div class="input-group-append">--}}
{{--                                    <span class="input-group-text" id="basic-addon2">{{__('hours')}}</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            @endif

{{--            <div class="row">--}}
{{--                <div class="col-lg-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="control-label">{{__("Tour Min People")}}</label>--}}
{{--                        <input type="text" name="min_people" class="form-control" value="{{$row->min_people}}" placeholder="{{__("Tour Min People")}}">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label class="control-label">{{__("Tour Max People")}}</label>--}}
{{--                        <input type="text" name="max_people" class="form-control" value="{{$row->max_people}}" placeholder="{{__("Tour Max People")}}">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

        @endif
<!--        <?php //do_action(\Modules\Tour\Hook::FORM_AFTER_MAX_PEOPLE,$row) ?> -->
{{--        <div class="form-group-item">--}}
{{--            <label class="control-label">{{__('FAQs')}}</label>--}}
{{--            <div class="g-items-header">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-5">{{__("Title")}}</div>--}}
{{--                    <div class="col-md-5">{{__('Content')}}</div>--}}
{{--                    <div class="col-md-1"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="g-items">--}}
{{--                @if(!empty($translation->faqs))--}}
{{--                    @php if(!is_array($translation->faqs)) $translation->faqs = json_decode($translation->faqs); @endphp--}}
{{--                    @foreach($translation->faqs as $key=>$faq)--}}
{{--                        <div class="item" data-number="{{$key}}">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-5">--}}
{{--                                    <input type="text" name="faqs[{{$key}}][title]" class="form-control" value="{{$faq['title']}}" placeholder="{{__('Eg: When and where does the tour end?')}}">--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <textarea name="faqs[{{$key}}][content]" class="form-control full-h" placeholder="...">{{$faq['content']}}</textarea>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-1">--}}
{{--                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            <div class="text-right">--}}
{{--                <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>--}}
{{--            </div>--}}
{{--            <div class="g-more hide">--}}
{{--                <div class="item" data-number="__number__">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-5">--}}
{{--                            <input type="text" __name__="faqs[__number__][title]" class="form-control" placeholder="{{__('Eg: When and where does the tour end?')}}">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <textarea __name__="faqs[__number__][content]" class="form-control full-h" placeholder="..."></textarea>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-1">--}}
{{--                            <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        @include('Tour::admin/tour/include-exclude')
{{--        @include('Tour::admin/tour/itinerary')--}}
        @include('Tour::admin/tour/itinerary-text')
        @if(is_default_lang())
            <div class="form-group">
                <label class="control-label">{{__("Banner Image")}}</label>
                <div class="form-group-image">
                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('banner_image_id',$row->banner_image_id) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">{{__("Gallery")}}</label>
                {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
            </div>
        @endif
    </div>
</div>

