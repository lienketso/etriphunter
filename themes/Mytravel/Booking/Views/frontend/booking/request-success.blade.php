@extends('layouts.app')
@section('head')
    <style type="text/css">
        .success-request-tour{
            padding-top: 50px;
            padding-bottom: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="success-request-tour">
        <div class="container">
            <div class="info-success-tour">
                {!! setting_item_with_lang('tour_request_success',request()->query('lang')) !!}
            </div>
        </div>
    </div>
@endsection
