@extends('layouts.app')
@section('head')
<style type="text/css">
    .media-left{
        max-width: 150px;
    }
    .media-body .media-heading{
        font-size: 18px;
    }
    .media-left img{
        max-width: 100%;
    }
    .media-body{
        padding-left: 20px;
    }
    .review-item{
        padding-bottom: 50px;
    }
    .review-star{
        display: inline-flex;
        list-style: none;
    }
    .review-star li{
        padding-right: 10px;
    }
    .review-star li i{
        color: burlywood;
    }
    .review-item-body h4{
        font-size: 16px;
        font-weight: bold;
        padding-top: 5px;
    }
</style>
@endsection
@section('content')
<div class="page-profile-content page-template-content">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-3">
                    @include('User::frontend.profile.sidebar')
                </div>
                <div class="col-md-9">
                    <h3 class="profile-name">{{__("Hi, I'm :name",['name'=>(!is_null($user->company_id)) ? $user->company->name : $user->business_name])}}</h3>
                    <div class="profile-bio">{!! (!is_null($user->company_id)) ? $user->company->content : $user->bio !!}</div>
                    @include('User::frontend.profile.services')
                    <div class="div" style="margin-top: 40px;">
                        @include('User::frontend.profile.reviews')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
