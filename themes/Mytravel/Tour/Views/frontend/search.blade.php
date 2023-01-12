@extends('layouts.app')
@section('head')
    <link href="{{ asset('themes/mytravel/dist/frontend/module/tour/css/tour.css?_ver='.config('app.asset_version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("themes/mytravel/libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}"/>
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
        .item-shedule span{
            background: #5191fa;
            color: #fff;
            padding: 5px 15px;
            margin: 10px;
            border-radius: 5px;
        }
    </style>
@endsection
@section('content')

    <div class="bravo_search_tour mt-7">
        <div class="container">
            {{--slider location --}}
            @if(!empty($trip_ideas))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider-search-location bravo-gallery-location ">
                            <div class="item-search-location owl-carousel">
                                @foreach($trip_ideas as $d)

                                    <div class="item-location">
                                        <a href="{{$d['link']}}"
                                           target="_blank"
                                           style="background-image: url('{{get_file_url($d['image_id'],'thumb')}}')">
                                        </a>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @include('Tour::frontend.layouts.search.list-item')
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        $(".bravo-gallery-location").each(function () {
            $(this).find(".owl-carousel").owlCarousel({
                items: 1,
                loop: true,
                margin: 0,
                nav: false,
                dots: true,
                autoplay: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })
        });
    </script>
    <script type="text/javascript" src="{{ asset("themes/mytravel/libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset('themes/mytravel/module/tour/js/tour.js?_ver='.config('app.asset_version')) }}"></script>
@endsection
