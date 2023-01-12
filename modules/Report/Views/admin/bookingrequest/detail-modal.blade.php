@php
    $guestJson = json_decode($booking->persion);
    $locationJson = json_decode($booking->location);
@endphp
<div class="modal fade" id="modal-booking-request-{{$booking->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{__("Booking ID")}}: #{{$booking->id}}</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#booking-detail-{{$booking->id}}">{{__("Booking Detail")}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#booking-customer-{{$booking->id}}">
                            {{__("Customer Information")}}
                        </a>
                    </li>
                    @if(!is_null($booking->commission_type))
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#booking-commission-{{$booking->id}}">
                            {{__("Etrip commission")}}
                        </a>
                    </li>
                        @endif
                </ul>
                <div class="tab-content">
                    <div id="booking-detail-{{$booking->id}}" class="tab-pane active"><br>
                        <div class="booking-review">
                            <div class="booking-review-content">
                                <div class="review-section">
                                    <div class="info-form">
                                        <ul>
                                            <li>
                                                <div class="label">{{__('Booking Status')}}</div>
                                                <div class="val">{{$booking->status}}</div>
                                            </li>
                                            <li>
                                                <div class="label">{{__('Booking Date')}}</div>
                                                <div class="val">{{showVNdate($booking->created_at)}}</div>
                                            </li>
                                            <li>
                                                <div class="label">{{__('Guest Info')}}</div>
                                                <div class="val p-nopadding">
                                                    <p>Người lớn : {{$guestJson->adult}}</p>
                                                    <p>Trẻ em ( 6-16 ) : {{$guestJson->child}}</p>
                                                    <p>Trẻ em ( 2 - 5 ) : {{$guestJson->young}}</p>
                                                    <p>Em bé ( <2 ) : {{$guestJson->baby}}</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="label">{{__('Time')}}</div>
                                                <div class="val p-nopadding">
                                                    <p>Ngày đi : {{showVNdate($booking->start_date)}}</p>
                                                    <p>Ngày về : {{showVNdate($booking->end_date)}}</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="label">{{__('Locations')}}</div>
                                                <div class="val p-nopadding">
                                                    <p>Điểm đi : {{$locationJson->from_where}}</p>
                                                    <p>Điểm đến : {{$locationJson->to_where}}</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="label">{{__('Vehicle')}}</div>
                                                <div class="val p-nopadding">
                                                    @if(!is_null($booking->vehicle))
                                                        @php
                                                            $vehicleJson = json_decode($booking->vehicle)
                                                        @endphp
                                                        @foreach($vehicleJson as $v)
                                                            <p>{{$v}}</p>
                                                        @endforeach
                                                    @else
                                                        <p>Chưa chọn</p>
                                                    @endif
                                                </div>
                                            </li>
                                            <li>
                                                <div class="label">{{__('Hotel')}}</div>
                                                <div class="val">{{$booking->hotel}} *</div>
                                            </li>
                                            <li>
                                                <div class="label">{{__('Vendor')}}</div>
                                                <div class="val">{{ ($booking->vendor_id!=0) ? $booking->vendor->name : 'Chưa chọn vendor'}}</div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="more-booking-review">

                        </div>
                    </div>
                    <div id="booking-customer-{{$booking->id}}" class="tab-pane fade"><br>
                        <div class="pt-4 pb-5 px-5 border-bottom booking-review">
                            <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-2">
                                {{ __("Customer Information") }}
                            </h5>
                            <!-- Fact List -->
                            <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                                <li class="info-first-name d-flex justify-content-between py-2">
                                    <div class="label">{{__('Company')}}</div>
                                    <div class="val">{{$booking->company}}</div>
                                </li>
                                <li class="info-last-name d-flex justify-content-between py-2">
                                    <div class="label">{{__('Contact Name')}}</div>
                                    <div class="val">{{$booking->name}}</div>
                                </li>
                                <li class="info-last-name d-flex justify-content-between py-2">
                                    <div class="label">{{__('Position')}}</div>
                                    <div class="val">{{$booking->office}}</div>
                                </li>
                                <li class="info-email d-flex justify-content-between py-2">
                                    <div class="label">{{__('Email')}}</div>
                                    <div class="val">{{$booking->email}}</div>
                                </li>
                                <li class="info-phone d-flex justify-content-between py-2">
                                    <div class="label">{{__('Phone')}}</div>
                                    <div class="val">{{$booking->phone}}</div>
                                </li>
                                <li class="info-address d-flex justify-content-between py-2">
                                    <div class="label">{{__('Address line 1')}}</div>
                                    <div class="val">{{$booking->address}}</div>
                                </li>

                                <li class="info-notes d-flex justify-content-between py-2">
                                    <div class="label">{{__('Special Requirements')}}</div>
                                    <div class="val">{{$booking->description}}</div>
                                </li>
                            </ul>
                            <!-- End Fact List -->
                        </div>
                    </div>
                    @if(!is_null($booking->commission_type))
                        @php
                            $commission = json_decode($booking->commission_type)
                        @endphp
                    <div id="booking-commission-{{$booking->id}}" class="tab-pane fade">
                        <h5 id="scroll-description" class="font-size-21 font-weight-bold text-dark mb-2">
                            {{ __("Etrip Commission") }}
                        </h5>
                        <ul class="list-unstyled font-size-1 mb-0 font-size-16">
                            <li class="info-first-name d-flex justify-content-between py-2">
                                <div class="label">{{__('Adult')}}</div>
                                <div class="val">{{format_money($commission->adult)}}</div>
                            </li>
                            <li class="info-first-name d-flex justify-content-between py-2">
                                <div class="label">{{__('Child ( 6 - 16 )')}}</div>
                                <div class="val">{{format_money($commission->child)}}</div>
                            </li>
                            <li class="info-first-name d-flex justify-content-between py-2">
                                <div class="label">{{__('Child ( 2 - 5 )')}}</div>
                                <div class="val">{{format_money($commission->young)}}</div>
                            </li>
                            <li class="info-first-name d-flex justify-content-between py-2">
                                <div class="label">{{__('Child ( <2 )')}}</div>
                                <div class="val">{{format_money($commission->baby)}}</div>
                            </li>
                            <li class="info-first-name d-flex justify-content-between py-2">
                                <div class="label">{{__('Total commission')}}</div>
                                <div class="val"><strong>{{format_money($booking->commission)}}</strong></div>
                            </li>
                        </ul>
                    </div>
                        @endif

                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <span class="btn btn-secondary" data-dismiss="modal">{{__("Close")}}</span>
            </div>
        </div>
    </div>
</div>
<style>
    .p-nopadding p{
        padding-bottom: 5px;
        margin-bottom: 0;
    }
</style>
