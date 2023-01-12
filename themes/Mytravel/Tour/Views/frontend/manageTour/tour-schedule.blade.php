@extends('layouts.user')
@section('head')

@endsection
@section('content')
<h2 class="title-bar">
    {{__("Tours Schedule")}}
        <a href="{{ route("tour.vendor.schedulecreate",['target_id'=>$row->id]) }}" class="btn-change-password">{{__("Add Schedule")}}</a>
</h2>
@include('admin.message')
<div class="panel">
    <div class="panel-title">Tour Name : <strong>{{$row->title}}</strong></div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="150px"> Ngày khởi hành</th>
                        <th width="150px"> Ngày về</th>
                        <th width="80px"> Số chỗ</th>
                        <th width="100px"></th>
                    </tr>
                </thead>
                        <tbody>
                @foreach($dates as $date)
                    <tr>
                        <td >{{showVNdate($date->start_date)}}</td>
                        <td >{{showVNdate($date->end_date)}}</td>
                        <td >{{($date->active)<=0 ? 'Hết chỗ' : $date->active}}</td>
                        <td>
                            <a href="{{ route("tour.vendor.scheduleedit",['target_id'=>$row->id,'id'=>$date->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
