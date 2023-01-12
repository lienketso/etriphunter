@extends('layouts.user')
@section('head')

@endsection
@section('content')
<h2 class="title-bar">
    {{__("Schedule edit")}}
</h2>
@include('admin.message')
<div class="panel">
    <div class="panel-title">Tour Name : <strong>{{$row->title}}</strong></div>
    <div class="panel-body">
        <form action="{{route('tour.vendor.storeschedule',['target_id'=>$row->id,'id'=>($date->id) ? $date->id : '-1'])}}" method="post">
            @csrf
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __('Start date')}}</label>
                <input type="text" value="{{ old('start_date',$date->start_date ? date("m/d/Y",strtotime($date->start_date)) :'') }}"
                       placeholder="{{ __('Start date')}}" name="start_date" class="form-control date-picker">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __('End date')}}</label>
                <input type="text" value="{{ old('end_date',$date->end_date ? date("m/d/Y",strtotime($date->end_date)) :'') }}"
                       placeholder="{{ __('End date')}}" name="end_date" class="form-control date-picker">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>{{__("Active")}}</label>
                <input type="text" name="active"  value="{{$date->active}}" placeholder="{{__("Active slot")}}" class="form-control">
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{__('Save Changes')}}</button>
        </div>
        </form>
    </div>
</div>
@endsection
