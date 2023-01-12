@extends('admin.layouts.app')
@section('title','Privilege')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("User Privileges")}}</h1>
        </div>
        @include('admin.message')         
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-body">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th > {{ __('Username')}}</th>
                                    <th > {{ __('Privilege')}}</th>
                                    <th > {{ __('Amount')}}</th>
                                    <th > {{ __('Available')}}</th>
                                    <th > {{ __('Count')}}</th>
                                    <th ></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!is_null($data))
                                    @foreach($data as $row)                                                      
                                        <tr>
                                            <td>{{$row->name}}</a></td>
                                            <td>{{$row->privilege->privilege_name}}</td>
                                            <td>{{$row->privilege_amount}}</td>
                                            <td>{{$row->privilege_available}}</td> 
                                            <td>{{$row->privilege_count}}</td> 
                                            <td>
                                                <a href="{{route('privilege.admin.userdetail',['id'=>$row->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                            </td>
                                        </tr>
                                    
                                    @endforeach
                                    
                                @else
                                    <tr>
                                        <td colspan="6">{{__("No data")}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
