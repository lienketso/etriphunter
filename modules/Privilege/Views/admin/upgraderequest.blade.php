@extends ('admin.layouts.app')
@section ('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('All Bookings')}}</h1>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between">
            <div class="col-left">
                @if(!empty($booking_update))
                    <form method="post" action="{{route('report.admin.booking.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                        @csrf
                        <select name="action" class="form-control">
                            <option value="">{{__("-- Bulk Actions --")}}</option>
                            @if(!empty($statues))
                                @foreach($statues as $status)
                                    <option value="{{$status}}">{{__('Mark as: :name',['name'=>booking_status_to_text($status)])}}</option>
                                @endforeach
                            @endif
                            <option value="delete">{{__("DELETE booking")}}</option>
                        </select>
                        <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Apply')}}</button>
                    </form>
                @endif
            </div>
            <div class="col-left">
                <form method="get" action="" class="filter-form filter-form-right d-flex justify-content-end">
                    @csrf
                    <input type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search by name or ID')}}" class="form-control">
                    <button class="btn-info btn btn-icon" type="submit">{{__('Filter')}}</button>
                </form>
            </div>
        </div>
        <div class="text-right">
            <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
        </div>
        <div class="panel booking-history-manager">
            <div class="panel-title">{{__('Bookings')}}</div>
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <table class="table table-hover bravo-list-item">
                        <thead>
                        <tr>
                            <th width="80px"><input type="checkbox" class="check-all"></th>
                            <th>{{__('Service')}}</th>
                            <th>{{__('Customer')}}</th>

                            <th>{{__('Payment Information')}}</th>
                            <th width="80px">{{__('Status')}}</th>
                            <th width="150px">{{__('Payment Method')}}</th>
                            <th width="120px">{{__('Created At')}}</th>
                            <th width="80px">{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                            @php  $booking = $row; @endphp
                            @php $infoCommission = json_decode($row->commission_type); @endphp
                            <tr>
                                <td><input type="checkbox" class="check-item" name="ids[]" value="{{$row->id}}">
                                    #{{$row->id}}</td>
                                <td>
                                    @if($privileges->where('id', $row->object_id))                                
                                        {{$privileges->where('id', $row->object_id)->first()->privilege_name}}                                        
                                    @endif
                                </td>
                                <td>
                                    <ul>
                                        <li>{{__("Name:")}} {{$row->first_name}} {{$row->last_name}} </li>
                                        <li>{{__("Email:")}} {{$row->email}}</li>
                                        <li>{{__("Phone:")}} {{$row->phone}}</li>
                                        <li>{{__("Address:")}} {{$row->address}}</li>
                                        <li>{{__("Custom Requirement:")}} {{$row->customer_notes}}</li>
                                    </ul>
                                </td>
                                <td>{{__("Total")}} : {{format_money_main($row->total)}}<br/>
                                    {{__("Paid")}} : {{format_money_main($row->paid)}}<br/>
                                    {{__("Remain")}} : {{format_money_main($booking->total - $booking->paid)}}<br/>
                                </td>
                                <td>
                                    <span class="label label-{{$row->status}}">{{$row->statusName}}</span>
                                </td>
                                <td>
                                    {{$row->gatewayObj ? $row->gatewayObj->getDisplayName() : ''}}
                                </td>
                                <td>{{display_datetime($row->updated_at)}}</td>
                                <td>
                                    @if($service = $row->service)
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{__('Actions')}}
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-booking-{{$row->id}}">{{__('Detail')}}</a>
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-paid-{{$row->id}}">{{__('Set Paid')}}</a>
                                                <a class="dropdown-item" href="{{route('report.admin.booking.email_preview',['id'=>$row->id])}}">{{__('Email Preview')}}</a>
                                            </div>
                                        </div>
                                        @include ($service->checkout_booking_detail_modal_file ?? '')
                                        @include ($service->set_paid_modal_file ?? '')
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            {{$rows->links()}}
        </div>
    </div>
@endsection
@section('script.body')
    <script>
        $(document).on('click', '#set_paid_btn', function (e) {
            var id = $(this).data('id');
            $.ajax({
                url:bookingCore.url+'/booking/setPaidAmount',
                data:{
                    id: id,
                    remain: $('#modal-paid-'+id+' #set_paid_input').val(),
                },
                dataType:'json',
                type:'post',
                success:function(res){
                    alert(res.message);
                    window.location.reload();
                }
            });
        });
    </script>
@endsection
