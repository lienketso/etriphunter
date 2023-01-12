@extends('admin.layouts.app')

@section('content')
    <form action="{{route('privilege.admin.useredit',['id'=>$id ?? -1])}}" method="post" class="needs-validation" novalidate>
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$user->name}}</h1>
                </div>
            </div>

            @include('admin.message')
            <div class="row">
                    <div class="panel">
                        <div class="panel-title"><strong>{{ __('User Info')}}</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                 <div class="form-controls">
                                    <label>{{__('Privilege')}}</label>
                                    <select name="privilege_id" class="form-control">
                                        <option value="">No privilege</option>
                                        @foreach ($privileges as $privilege )
                                        <option value="{{$privilege->id}}"@if ($privilege->id==$user->privilege_id)
                                            selected
                                        @endif>{{$privilege->privilege_name}}</option>
                                        @endforeach                                       
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Privilege available till')}}</label>
                                        <input type="text" value="{{ old('privilege_available',$user->privilege_available ? date("Y/m/d",strtotime($user->privilege_available)) :'') }}" placeholder="{{ __('Privilege available till')}}" name="privilege_available" class="form-control has-datepicker input-group date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Privilege Amount")}}</label>
                                        <input type="text" name="privilege_amount"  value="{{$user->privilege_amount}}" placeholder="{{__("Privilege_Amount")}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Privilege Count")}}</label>
                                        <input type="text" name="privilege_count"  value="{{$user->privilege_count}}" placeholder="{{__("Privilege_Amount")}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span></span>
                            <button class="btn btn-primary" type="submit">{{ __('Save Change')}}</button>
                        </div>
                    </div>
            </div>
            
        
    </form>

@endsection
@section ('script.body')
@endsection
