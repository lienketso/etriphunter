@extends('admin.layouts.app')
@php
    $persionJson = json_decode($row->persion);
    $locationJson = json_decode($row->location);
@endphp
@section('content')
    <form action="{{route('report.admin.request-edit-post',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ').$row->name : __('Add new tour')}}</h1>
                </div>
                <div class="">

                </div>
            </div>
            @include('admin.message')
            <div class="lang-content-box">

                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__("Tour Content")}}</strong></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>{{__("Company")}}</label>
                                    <input type="text" value="{{$row->company}}" placeholder="{{__("Company")}}" name="company" class="form-control">
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Full Name")}}</label>
                                            <input type="text" name="name" class="form-control" value="{{$row->name}}" placeholder="{{__("Full Name")}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Position")}}</label>
                                            <input type="text" name="office" class="form-control" value="{{$row->office}}" placeholder="{{__("Position")}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{__("Address")}}</label>
                                    <input type="text" value="{{$row->address}}" placeholder="{{__("Address")}}" name="address" class="form-control">
                                </div>


                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">{{__("Email")}}</label>
                                                <input type="text" name="email" class="form-control" value="{{$row->email}}" placeholder="{{__("Email")}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">{{__("Phone")}}</label>
                                                <input type="text" name="phone" class="form-control" value="{{$row->phone}}" placeholder="{{__("Phone")}}">
                                            </div>
                                        </div>
                                    </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Start date")}}</label>
                                            <input type="text" name="start_date" class="form-control has-datetimepicker" value="{{showVNdate($row->start_date)}}" placeholder="{{__("Start date")}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("End date")}}</label>
                                            <input type="text" name="end_date" class="form-control has-datetimepicker" value="{{showVNdate($row->end_date)}}" placeholder="{{__("End date")}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("From where")}}</label>
                                            <input type="text" name="location[from_where]" class="form-control" value="{{$locationJson->from_where}}"
                                                   placeholder="{{__("From where")}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("To where")}}</label>
                                            <input type="text" name="location[to_where]" class="form-control" value="{{$locationJson->to_where}}"
                                                   placeholder="{{__("To where")}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Vehicle")}}</label>
                                            <div class="form-control">
                                            @if(!is_null($row->vehicle))
                                                @php
                                                    $vehicleJson = json_decode($row->vehicle);
                                                @endphp

                                                <input type="checkbox" {{(in_array(__('Air plain'),$vehicleJson)) ? 'checked' : '' }} value="{{__('Air plain')}}"
                                                       placeholder="{{__("Vehicle")}}" name="vehicle[]" ><span>{{__('Air plain')}}</span>
                                                <input type="checkbox" {{(in_array(__('Train'),$vehicleJson)) ? 'checked' : '' }} value="{{__('Train')}}"
                                                       placeholder="{{__("Vehicle")}}" name="vehicle[]" ><span>{{__('Train')}}</span>
                                                <input type="checkbox" {{(in_array(__('Car'),$vehicleJson)) ? 'checked' : '' }} value="{{__('Car')}}"
                                                       placeholder="{{__("Vehicle")}}" name="vehicle[]" ><span>{{__('Car')}}</span>
                                                @else
                                                    <input type="checkbox" value="{{__('Air plain')}}"
                                                           placeholder="{{__("Vehicle")}}" name="vehicle[]" ><span>{{__('Air plain')}}</span>
                                                    <input type="checkbox" value="{{__('Train')}}"
                                                           placeholder="{{__("Vehicle")}}" name="vehicle[]" ><span>{{__('Train')}}</span>
                                                    <input type="checkbox" value="{{__('Car')}}"
                                                           placeholder="{{__("Vehicle")}}" name="vehicle[]" ><span>{{__('Car')}}</span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Hotel")}}</label>
                                            <input type="text" name="hotel" class="form-control" value="{{$row->hotel}}"
                                                   placeholder="{{__("Hotel")}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="control-label">Người lớn</label>
                                            <input type="number" class="form-control" min="1" name="persion[adult]" value="{{$persionJson->adult}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="control-label">Trẻ em ( 6-16 )</label>
                                            <input type="number" class="form-control" min="0" name="persion[child]" value="{{$persionJson->child}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="control-label">Trẻ em ( 2-5 )</label>
                                            <input type="number" class="form-control" min="0" name="persion[young]" value="{{$persionJson->young}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="control-label">Trẻ nhỏ ( < 2 )</label>
                                            <input type="number" class="form-control" min="0" name="persion[baby]" value="{{$persionJson->baby}}">
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label">{{__("Special Requirements")}}</label>
                                    <textarea class="form-control" name="description" rows="4">{{$row->description}}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__('Advance info')}}</strong></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label">{{__("Status")}}</label>
                                    <select name="status" class="form-control">
                                        <option value="pending" {{($row->status=='pending' ? 'selected' : '')}}>Chưa xử lý</option>
                                        <option value="draft" {{($row->status=='draft' ? 'selected' : '')}}>Nháp</option>
                                        <option value="vendor" {{($row->status=='vendor' ? 'selected' : '')}}>Đã gửi vendor</option>
                                        <option value="processing" {{($row->status=='processing' ? 'selected' : '')}}>Đang xử lý</option>
                                        <option value="confirmed" {{($row->status=='confirmed' ? 'selected' : '')}}>Đã xác nhận</option>
                                        <option value="completed" {{($row->status=='completed' ? 'selected' : '')}}>Hoàn thành</option>
                                        <option value="cancel" {{($row->status=='cancel' ? 'selected' : '')}}>Hủy</option>
                                        <option value="canceled" {{($row->status=='canceled' ? 'selected' : '')}}>Đã hủy</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{__("Organizational units")}}</label>
                                    <select name="vendor_id" class="form-control">
                                        <option value="">{{__("-- Please Select --")}}</option>
                                        @foreach($vendors as $v)
                                        <option value="{{$v->id}}" {{($v->id==$row->vendor_id) ? 'selected' : ''}}>{{$v->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{__("Price")}}</label>
                                    <input type="number" min="0" name="price" placeholder="{{__("Price")}}" value="{{$row->price}}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="panel">
                            <div class="panel-title"><strong>{{__('Commission for Etrip')}}</strong></div>
                            <div class="panel-body">
                                @if(!is_null($row->commission_type))
                                    @php
                                        $commission = json_decode($row->commission_type);
                                    @endphp
                                <div class="form-group">
                                    <label class="control-label">{{__("Adult")}}</label>
                                    <input type="number" min="0" value="{{$commission->adult}}" class="form-control" name="commission[adult]" placeholder="Hoa hồng cho mỗi người lớn">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{__("Child (6 - 16 )")}}</label>
                                    <input type="number" min="0" value="{{$commission->child}}" class="form-control" name="commission[child]" placeholder="Hoa hồng cho trẻ em 6 - 16 tuổi">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{__("Child (2 - 5 )")}}</label>
                                    <input type="number" min="0" value="{{$commission->young}}" class="form-control" name="commission[young]" placeholder="Hoa hồng cho mỗi trẻ em 2 - 5 tuổi">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">{{__("Child ( <2 )")}}</label>
                                    <input type="number" min="0" value="{{$commission->baby}}" class="form-control" name="commission[baby]" placeholder="Hoa hồng cho mỗi em bé < 2 tuổi">
                                </div>
                                    @else
                                    <div class="form-group">
                                        <label class="control-label">{{__("Adult")}}</label>
                                        <input type="number" min="0" class="form-control" name="commission[adult]" value="{{old('commission[adult]',1)}}" placeholder="Hoa hồng cho mỗi người lớn">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">{{__("Child (6 - 16 )")}}</label>
                                        <input type="number" min="0" class="form-control" name="commission[child]" value="{{old('commission[child]',0)}}" placeholder="Hoa hồng cho trẻ em 6 - 16 tuổi">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">{{__("Child (2 - 5 )")}}</label>
                                        <input type="number" min="0" class="form-control" name="commission[young]" value="{{old('commission[young]',0)}}" placeholder="Hoa hồng cho mỗi trẻ em 2 - 5 tuổi">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">{{__("Child ( <2 )")}}</label>
                                        <input type="number" min="0" class="form-control" name="commission[baby]" value="{{old('commission[baby]',0)}}" placeholder="Hoa hồng cho mỗi em bé < 2 tuổi">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="text-right">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{__('Save Changes')}}</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section ('script.body')
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
