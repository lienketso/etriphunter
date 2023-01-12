@extends('layouts.app')
@section('content')
    <div class="bravo-booking-page padding-content" >
        <div class="container">
            <div id="bravo-checkout-page" >
                <div class="row">
                    <div class="col-md-8">
                        <div class="alert alert-{{$status}} alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{$message}}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
