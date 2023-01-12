@extends('layouts.user')
@section('head')

@endsection

@section('content')
    <form action="{{route('vendor.bookingRequestUpdate.post',['id'=>($row->id) ? $row->id : '-1'])}}" method="post">
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
                                    <input type="text" value="{{$row->company}}" disabled="disabled" placeholder="{{__("Company")}}" name="company" class="form-control">
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Full Name")}}</label>
                                            <input type="text" name="name" disabled="disabled" class="form-control" value="{{$row->name}}" placeholder="{{__("Full Name")}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Position")}}</label>
                                            <input type="text" name="office" disabled="disabled" class="form-control" value="{{$row->office}}" placeholder="{{__("Position")}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{__("Address")}}</label>
                                    <input type="text" value="{{$row->address}}" disabled="disabled" placeholder="{{__("Address")}}" name="address" class="form-control">
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("Start date")}}</label>
                                            <input type="text" name="start_date" disabled="disabled" class="form-control has-datetimepicker" value="{{showVNdate($row->start_date)}}" placeholder="{{__("Start date")}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">{{__("End date")}}</label>
                                            <input type="text" name="end_date" disabled="disabled" class="form-control has-datetimepicker" value="{{showVNdate($row->end_date)}}" placeholder="{{__("End date")}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">{{__("Special Requirements")}}</label>
                                    <textarea class="form-control" name="description" disabled="disabled" rows="4">{{$row->description}}</textarea>
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
                                        <option value="vendor" {{($row->status=='vendor' ? 'selected' : '')}}>Đang xác nhận</option>
                                        <option value="confirmed" {{($row->status=='confirmed' ? 'selected' : '')}}>Nhận tour này</option>
                                        <option value="cancel" {{($row->status=='cancel' ? 'selected' : '')}}>Hủy</option>
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
                                        <input type="number" min="0" value="{{$commission->adult}}" class="form-control" name="commission_type[adult]" placeholder="Hoa hồng cho mỗi người lớn">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">{{__("Child (6 - 16 )")}}</label>
                                        <input type="number" min="0" value="{{$commission->child}}" class="form-control" name="commission_type[child]" placeholder="Hoa hồng cho trẻ em 6 - 16 tuổi">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">{{__("Child (2 - 5 )")}}</label>
                                        <input type="number" min="0" value="{{$commission->young}}" class="form-control" name="commission_type[young]" placeholder="Hoa hồng cho mỗi trẻ em 2 - 5 tuổi">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">{{__("Child ( <2 )")}}</label>
                                        <input type="number" min="0" value="{{$commission->baby}}" class="form-control" name="commission_type[baby]" placeholder="Hoa hồng cho mỗi em bé < 2 tuổi">
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label class="control-label">{{__("Adult")}}</label>
                                        <input type="number" min="0" class="form-control" name="commission_type[adult]" value="{{old('commission_type[adult]',1)}}" placeholder="Hoa hồng cho mỗi người lớn">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">{{__("Child (6 - 16 )")}}</label>
                                        <input type="number" min="0" class="form-control" name="commission_type[child]" value="{{old('commission_type[child]',0)}}" placeholder="Hoa hồng cho trẻ em 6 - 16 tuổi">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">{{__("Child (2 - 5 )")}}</label>
                                        <input type="number" min="0" class="form-control" name="commission_type[young]" value="{{old('commission_type[young]',0)}}" placeholder="Hoa hồng cho mỗi trẻ em 2 - 5 tuổi">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">{{__("Child ( <2 )")}}</label>
                                        <input type="number" min="0" class="form-control" name="commission_type[baby]" value="{{old('commission_type[baby]',0)}}" placeholder="Hoa hồng cho mỗi em bé < 2 tuổi">
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
