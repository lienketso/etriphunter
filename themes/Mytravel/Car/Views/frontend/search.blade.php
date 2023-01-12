@extends('layouts.app')
@section('head')
    <link href="{{ asset('/themes/mytravel/dist/frontend/module/car/css/car.css?_ver='.config('app.version')) }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset("/themes/mytravel/libs/ion_rangeslider/css/ion.rangeSlider.min.css") }}"/>
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
    </style>
@endsection
@section('content')
    <div class="bravo_search_car">
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
            @include('Car::frontend.layouts.search.list-item')
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
    <script type="text/javascript" src="{{ asset("/themes/mytravel/libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset('/themes/mytravel/module/car/js/car.js?_ver='.config('app.version')) }}"></script>
@endsection
