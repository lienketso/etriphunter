@extends('layouts.app')
@section('head')
    <link href="{{ asset('/themes/mytravel/dist/frontend/module/event/css/event.css?_ver='.config('app.version')) }}" rel="stylesheet">
<style type="text/css">
    .slider-search-location{
        padding-bottom: 30px;
    }
    .item-location a{
        display: block;
        min-height: 400px;
        width: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .table-list-tour table{
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ccc;
    }
    .table-list-tour table tr td{
        border: 1px solid #ccc;
        padding: 10px;
    }
    .book-list-tour{
        background: #d42681;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
    }
    .book-list-tour:hover{
        background: #5191fa;
        color: #fff;
    }
    .item-list{
        padding-bottom: 30px;
    }
    .item-title{
        font-weight: bold;
    }
    .item-title a{
        color: #000;
    }
    .item-title a:hover{
        color: #5191fa;
    }
    .location{
        font-size: 15px;
        padding: 3px 0;
    }
    .location span{
        padding-right: 10px;
    }
    .book-button{
        text-align: right;
    }
    .price-sale{
        color: #cc0033 !important;
        text-decoration: line-through;
    }
    .price{
        font-weight: bold;
        color: #000;
    }
    .logo-vendor{
        text-align: center;
        width: 100%;
    }
    .info-vendor-page h3{
        font-size: 20px;
        font-weight: bold;
    }
    .list-item-vendor{
        padding-bottom: 20px;
    }
</style>
@endsection

@section('content')
    <div class="bravo_search_tour mt-7">
        <div class="container">
            <div class="row">
            <div class="col-lg-3">
                <div class="info-vendor-page">
                    <div class="logo-vendor">
                        <img src="{{get_file_url($vendor->avatar_id,'thumb','')}}" alt="{{$vendor->name}}">
                    </div>
                    <h3>{{$vendor->name}}</h3>
                    <p>Địa chỉ : {{$vendor->address}}</p>
                    <div class="desction-vendor">
                        {!! $vendor->bio !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="list-item-vendor">
                    <div class="bravo-list-item">

                            <div class="row">

                                    @if($tours->total() > 0)
                                    <div class="col-lg-12">
                                        <h4>Dịch vụ tour</h4>
                                    </div>
                                       @foreach($tours as $row)
                                           <div class="col-md-6 col-lg-4 col-xl-4 mb-4 mb-md-4 pb-1">
                                               <div class="list-item-vendor">
                                                @include('Vendor::frontend.list-tour')
                                               </div>
                                           </div>
                                           @endforeach
                                    @else
                                        <div class="col-lg-12">
                                            {{__("Tour not found")}}
                                        </div>
                                    @endif

                                    @if($hotel->total() > 0)
                                            <div class="col-lg-12">
                                                <h4>Khách sạn</h4>
                                            </div>
                                            @foreach($tours as $row)
                                            <div class="col-md-6 col-lg-4 col-xl-4 mb-4 mb-md-4 pb-1">
                                                @include('Vendor::frontend.list-hotel')
                                            </div>
                                            @endforeach
                                    @endif

                                        @if($cars->total() > 0)
                                            <div class="col-lg-12">
                                                <h4>Dịch vụ xe</h4>
                                            </div>
                                            @foreach($cars as $row)
                                                <div class="col-md-6 col-lg-4 col-xl-4 mb-4 mb-md-4 pb-1">
                                                    @include('Vendor::frontend.list-car')
                                                </div>
                                            @endforeach
                                        @endif

                                        @if($flight->total() > 0)
                                            <div class="col-lg-12">
                                                <h4>Vé máy bay</h4>
                                            </div>
                                            @foreach($flight as $row)
                                                <div class="col-md-6 col-lg-4 col-xl-4 mb-4 mb-md-4 pb-1">
                                                    @include('Vendor::frontend.list-flight')
                                                </div>
                                            @endforeach
                                        @endif

                                        @if($utilities->total() > 0)
                                            <div class="col-lg-12">
                                                <h4>Tiện ích</h4>
                                            </div>
                                            @foreach($utilities as $row)
                                                <div class="col-md-6 col-lg-4 col-xl-4 mb-4 mb-md-4 pb-1">
                                                    @include('Vendor::frontend.list-utilities')
                                                </div>
                                            @endforeach
                                        @endif
                                </div>

                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
