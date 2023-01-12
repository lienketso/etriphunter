@extends('layouts.user')
@section('head')

@endsection
@section('content')

    <h2 class="title-bar no-border-bottom">
        {{__("Danh sách tài khoản")}}
        <a href="{{route('vendor.add-user')}}" class="btn-change-password">Thêm tài khoản</a>
    </h2>
    @include('admin.message')
    <div class="booking-history-manager">
        <div class="tabbable">

            @if(!empty($user) and $user->total() > 0)
                <div class="tab-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-booking-history">
                            <thead>
                            <tr>
                                <th width="2%">{{__("Name")}}</th>
                                <th>{{__("Email")}}</th>
                                <th class="a-hidden">{{__("Phone")}}</th>
                                <th class="a-hidden">{{__("Address")}}</th>
                                <th width="15%">{{__("Created at")}}</th>
                                <th>{{__("Action")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $d)
                            <tr>
                                <td>{{$d->name}}</td>
                                <td>{{$d->email}}</td>
                                <td>{{$d->phone}}</td>
                                <td>{{$d->address}}</td>
                                <td>{{showVNdate($d->created_at)}}</td>
                                <td><a class="btn btn-primary" href="{{route('vendor.edit-vendor-user',$d->id)}}"><i class="fa fa-edit"></i> Sửa</a></td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="bravo-pagination">
                        {{$user->appends(request()->query())->links()}}
                    </div>
                </div>
            @else
                Không tìm thấy tài khoản nào
            @endif
        </div>
    </div>
@endsection
