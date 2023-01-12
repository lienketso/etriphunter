@extends ('admin.layouts.app')
@section ('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('All Bookings')}}</h1>
        </div>
    @include('admin.message')
        <div class="filter-div d-flex justify-content-between">
            <div class="col-left">
                <form method="get" action="" class="filter-form filter-form-right d-flex justify-content-end">
                @csrf
                    <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Name,phone,email,ID')}}" class="form-control">
                    <button class="btn-info btn btn-icon" type="submit">{{__('Filter')}}</button>
                </form>
            </div>
        </div>
        <div class="panel booking-history-manager">
            <div class="panel-title">{{__('Bookings')}}</div>
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <table class="table table-hover bravo-list-item">
                        <thead>
                        <tr>
                            <th width="80px"><input type="checkbox" class="check-all"></th>
                            <th>{{__('Vendor')}}</th>
                            <th>{{__('Contact Name')}}</th>
                            <th width="180px" >{{__('Guest info')}}</th>
                            <th width="200px">{{__('Location')}}</th>
                            <th width="150px">{{__('Time')}}</th>
                            <th width="150px">{{__('Status')}}</th>
                            <th width="120px">{{__('Created At')}}</th>
                            <th width="80px">{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                            @php
                                $guest = json_decode($d->persion);
                                $location = json_decode($d->location);
                                $booking = $d;
                            @endphp
                        <tr>
                            <td><input type="checkbox" class="check-item" name="ids[]" value="{{$d->id}}"> #{{$d->id}}</td>
                            <td>{{ ($d->vendor_id!=0) ? $d->vendor->name : 'Chưa chọn vendor'}}</td>
                            <td>
                                <ul>
                                    <li>{{__("Company:")}} {{$d->company}} </li>
                                    <li>{{__("Name:")}} {{$d->name}} </li>
                                    <li>{{__("Position:")}} {{$d->office}} </li>
                                    <li>{{__("Email:")}} {{$d->email}}</li>
                                    <li>{{__("Phone:")}} {{$d->phone}}</li>
                                    <li>{{__("Address:")}} {{$d->address}}</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Người lớn : {{$guest->adult}}</li>
                                    <li>Trẻ em (6-16) : {{$guest->child}}</li>
                                    <li>Trẻ em (2-5) : {{$guest->young}}</li>
                                    <li>Trẻ nhỏ ( < 2 ) : {{$guest->baby}}</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>Điểm đi : {{$location->from_where}}</li>
                                    <li>Điểm đến : {{$location->to_where}}</li>
                                </ul>
                            </td>

                            <td>
                                <ul>
                                    <li>Ngày đi : {{showVNdate($d->start_date)}}</li>
                                    <li>Ngày về : {{showVNdate($d->end_date)}}</li>
                                </ul>
                            </td>
                            <td>
                                {!! requestBookingStatus($d->status) !!}
                            </td>
                            <td>{{showVNdateFull($d->created_at)}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{__('Actions')}}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-booking-request-{{$d->id}}">{{__('Detail')}}</a>
                                        <a class="dropdown-item" href="{{route('report.admin.request-edit',$d->id)}}" >{{__('Edit')}}</a>
                                    </div>
                                </div>
                                @include('Report::admin/bookingrequest.detail-modal')
                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>


    </div>
@endsection
