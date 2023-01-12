@extends('layouts.user')
@section('head')
@endsection
@section('content')
    <h2 class="title-bar">
        {{__("Upgrade privilege")}}
    </h2>
    @include('admin.message')
            <div class="col-md-12">
                <div class="panel">
                    <div class="row">
                    <div class="panel-body container-fluid">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="200px"> {{ __('Name')}}</th>
                                    <th> {{ __('Description')}}</th>
                                    <th width="150px"> {{ __('Max Amount')}}</th>
                                    <th width="100px"> {{ __('Discount')}}</th>
                                    <th width="100px"> {{ __('User')}}</th>
                                    <th width="100px"> {{ __('Price')}}</th>
                                    <th width="100px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!is_null($rows))
                                    @foreach($rows as $row)
                                        <tr>
                                            <td class="title">{{$row->privilege_name}}</a></td>
                                            <td>{!! $row->description !!}</td>
                                            <td>{{$row->amount}}</td>
                                            <td>{{$row->discount}}</td>
                                            <td>{{$row->max_user}}</td>
                                            <td>{{$row->price}}</td>
                                            <td>
                                                <a href="{{route('user.purchase_privilege',['id'=>$row->id])}}" class="btn btn-primary btn-sm">{{__('Purchase')}}</a>
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
                        {{$rows->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
@endsection

