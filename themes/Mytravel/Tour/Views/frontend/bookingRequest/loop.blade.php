@php
    $locationJson = json_decode($booking->location);
    @endphp
<tr>
    <td class="a-hidden">
        {{__('Contact name')}} : {{$booking->name}} <br/>
        {{__('Company')}} : {{$booking->company}}
    </td>
    <td class="a-hidden">{{showVNdate($booking->created_at)}}</td>
    <td class="a-hidden">
        {{__("Check in")}} : {{showVNdate($booking->start_date)}} <br/>
        {{__("Check out")}} : {{ showVNdate($booking->end_date) }}
    </td>
    <td>{{$booking->total_guest}}</td>
    <td class="a-hidden">
        {{__("From where")}} : {{$locationJson->from_where}}<br/>
        {{__("To where")}} : {{$locationJson->to_where}}
    </td>
    <td width="2%">

            <a class="btn btn-xs btn-primary btn-info-booking" data-toggle="modal" data-target="#modal-booking-request-{{$booking->id}}">
                <i class="fa fa-info-circle"></i>{{__("Details")}}
            </a>
            @include ('Tour::frontend.bookingRequest.detail-modal')

        <a href="{{route('vendor.bookingRequestUpdate',$booking->id)}}" class="btn btn-xs btn-primary btn-info-booking open-new-window mt-1" >
            <i class="fa fa-edit"></i>{{__("Upgrade")}}
        </a>


    </td>
</tr>
