@extends('layouts.app')
@section('head')
    <link href="{{ asset('dist/frontend/module/booking/css/checkout.css?_ver='.config('app.version')) }}" rel="stylesheet">
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
@endsection
@section('content')
    <div class="bravo-booking-page">
        <div id="bravo-checkout-page" class="bg-gray space-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-xl-12">
                        <div class="booking-form">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-checkout" id="form-booking-request">
                                <form method="post" action="{{route('booking.request')}}">
                                    {{csrf_field()}}
                                <div class="mb-5 shadow-soft bg-white rounded-sm">
                                    <div class="pt-4 pb-5 px-5">
                                        <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-4">
                                            {{ __("Form request a quote") }}
                                        </h5>
                                        <div class="row">
                                            <div class="col-sm-12 mb-4">
                                                <label class="form-label">
                                                    {{ __("Company Name") }}
                                                </label>
                                                <input type="text" placeholder="{{__("Company Name")}}" class="form-control" value="{{old('company')}}"
                                                       name="company">
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    {{ __("Full Name") }} <span class="required-alert"> * </span>
                                                </label>
                                                <input type="text" placeholder="{{__("Full Name")}}" class="form-control" value="{{$user->name ?? ''}}"
                                                       name="name" >
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    {{ __("Office") }}
                                                </label>
                                                <input type="text" placeholder="{{__("Office")}}" class="form-control" value="{{old('office')}}"
                                                       name="office" >
                                            </div>
                                            <div class="col-sm-12 mb-4">
                                                <label class="form-label">
                                                    {{ __("Address") }}
                                                </label>
                                                <input type="text" placeholder="{{__("Address")}}" class="form-control" value="{{old('address')}}"
                                                       name="address">
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    {{ __("Email") }}
                                                </label>
                                                <input type="email" placeholder="{{__("email@domain.com")}}" class="form-control" value="{{$user->email ?? ''}}"
                                                       name="email">
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    {{ __("Phone") }} <span class="required-alert"> * </span>
                                                </label>
                                                <input type="text" placeholder="{{__("Your Phone")}}" class="form-control" value="{{$user->phone ?? ''}}"
                                                       name="phone">
                                            </div>
                                            <div class="w-100"></div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    {{ __("Start date") }} <span class="required-alert"> * </span>
                                                </label>
                                                <input type="text" placeholder="{{ __("Start date") }}" class="form-control has-datetimepicker" value="{{old('start_date')}}"
                                                       name="start_date">
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    {{ __("End date") }} <span class="required-alert"> * </span>
                                                </label>
                                                <input type="text" placeholder="{{ __("End date") }}" class="form-control has-datetimepicker" value="{{old('end_date')}}"
                                                       name="end_date" >
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    {{ __("From where") }} <span class="required-alert"> * </span>
                                                </label>
                                                <input type="text" name="location[from_where]" value="{{old('location[from_where]')}}" placeholder="Ex : Hà Nội" class="form-control" />
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    {{ __("To where") }} <span class="required-alert"> * </span>
                                                </label>
                                                <input type="text" name="location[to_where]" value="{{old('location[to_where]')}}" placeholder="Ex : Đà Nẵng" class="form-control" />
                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    {{ __("Organizational units") }}
                                                </label>
                                                <select name="vendor_id" class="form-control">
                                                    <option value="">{{__('-- Select --')}}</option>
                                                    @foreach($listVendor as $d)
                                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                                        @endforeach
                                                </select>

                                            </div>
                                            <div class="col-sm-6 mb-4">
                                                <label class="form-label">
                                                    {{ __("Hotel type") }}
                                                </label>
                                                <input type="text" class="form-control" value="{{old('hotel')}}" name="hotel"
                                                       placeholder="{{__("5*")}}">
                                            </div>
                                            <div class="col-sm-12 mb-4">
                                                <label class="form-label">
                                                    {{ __("Vehicle") }}
                                                </label>
                                                <p class="vehicle-checkbox">
                                                    <input type="checkbox" name="vehicle[]" value="{{__("Air plane")}}" /> <span>{{__("Air plane")}}</span>
                                                    <input type="checkbox" name="vehicle[]" value="{{__("Train")}}" /> <span>{{__("Train")}}</span>
                                                    <input type="checkbox" name="vehicle[]" value="{{__("Car")}}" /> <span>{{__("Car")}}</span>
                                                </p>
                                            </div>
                                            <div class="col-sm-3 mb-4">
                                                <label class="form-label">
                                                    {{ __("Adult") }} <span class="required-alert"> * </span>
                                                </label>
                                                <input type="number" min="0" value="{{old('persion[adult]',1)}}" name="persion[adult]" class="form-control" placeholder="Total of adults">
                                            </div>
                                            <div class="col-sm-3 mb-4">
                                                <label class="form-label">
                                                    {{ __("Child (6-16 year old)") }}
                                                </label>
                                                <input type="number" min="0" value="{{old('persion[child]',0)}}" name="persion[child]" class="form-control" placeholder="Total of child ">
                                            </div>
                                            <div class="col-sm-3 mb-4">
                                                <label class="form-label">
                                                    {{ __("Child (2-5 year old)") }}
                                                </label>
                                                <input type="number" min="0" value="{{old('persion[young]',0)}}" name="persion[young]" class="form-control" placeholder="Total of child ">
                                            </div>
                                            <div class="col-sm-3 mb-4">
                                                <label class="form-label">
                                                    {{ __("Child (<2 year old)") }}
                                                </label>
                                                <input type="number" min="0" value="{{old('persion[baby]',0)}}" name="persion[baby]" class="form-control" placeholder="Total of baby ">
                                            </div>
                                            <div class="w-100"></div>
                                            <div class="col">
                                                <div class="mb-6">
                                                    <label class="form-label">
                                                        {{ __("Special Requirements") }}
                                                    </label>
                                                    <div class="input-group">
                                                        <textarea name="description" cols="30" rows="6" class="form-control" placeholder="{{__('Special Requirements')}}"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-100"></div>

                                            <div class="col-sm-12 mb-4">
                                                @php
                                                    $term_conditions = setting_item('booking_term_conditions');
                                                @endphp
                                                <div class="mb-3">
                                                    <div class="custom-control custom-checkbox d-flex align-items-center text-muted">
                                                        <input type="checkbox" class="custom-control-input" id="termsCheckbox" name="term_conditions">
                                                        <label class="custom-control-label" for="termsCheckbox">
                                                            <small>
                                                                {{__('By continuing, you agree to the')}}
                                                                <a target="_blank" class="link-muted" href="{{get_page_url($term_conditions)}}">{{__('Terms and Conditions')}}</a>
                                                            </small>
                                                        </label>
                                                    </div>
                                                    @if(setting_item("booking_enable_recaptcha"))
                                                        <div class="form-group">
                                                            {{recaptcha_field('booking')}}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="html_before_actions"></div>

                                                <button type="submit" class="btn btn-primary w-100 rounded-sm transition-3d-hover font-size-16 font-weight-bold py-3">
                                                    {{__('CONFIRM BOOKING')}}
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

@endsection

@section('footer')
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

@endsection
