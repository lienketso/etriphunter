@extends('layouts.user')
@section('head')

@endsection
@section('content')

    <h2 class="title-bar no-border-bottom">
        {{__("Booking Request")}}
    </h2>
    @include('admin.message')
    <div class="booking-history-manager">
        <div class="tabbable">
            <ul class="nav nav-tabs ht-nav-tabs">
                <?php $status_type = Request::query('status'); ?>
                    <li class="@if(empty($status_type)) active @endif">
                        <a href="{{route("vendor.bookingRequestReport")}}">Chưa xác nhận</a>
                    </li>
                    <li class="@if(!empty($status_type) && $status_type == 'processing') active @endif">
                            <a href="{{route("vendor.bookingRequestReport",['status'=>'processing'])}}">Đã xác nhận</a>
                    </li>
            </ul>
            @if(!empty($bookings) and $bookings->total() > 0)
                <div class="tab-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-booking-history">
                            <thead>
                            <tr>
                                <th>{{__("Customer info")}}</th>
                                <th class="a-hidden">{{__("Order Date")}}</th>
                                <th class="a-hidden">{{__("Execution Time")}}</th>
                                <th>{{__("Total Guests")}}</th>
                                <th>{{__("Location")}}</th>
                                <th>{{__("Action")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $booking)
                                @include('Tour::frontend.bookingRequest.loop')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="bravo-pagination">
                        {{$bookings->appends(request()->query())->links()}}
                    </div>
                </div>
            @else
                {{__("No Booking History")}}
            @endif
        </div>
    </div>

@endsection
@section('footer')

@endsection
