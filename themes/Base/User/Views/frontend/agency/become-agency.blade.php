@extends('layouts.user')
@section('head')

@endsection
@section('content')
    <h2 class="title-bar">
        {{__("Cập nhật hồ sơ đăng ký làm đại lý")}}
    </h2>
    @include('admin.message')
    @if($user->is_agency!=1)
    <form action="{{route('user.become_agency.post')}}" method="post" class="input-has-icon">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <p>Đăng ký đại lý cho :</p>
                    <input type="radio" name="agency_type" {{($user->agency_type=='personal') ? 'checked' : ''}} value="personal"> <span>Cá nhân</span>
                    <input type="radio" name="agency_type" {{($user->agency_type=='company') ? 'checked' : ''}} value="company"> <span>Doanh nghiệp</span>
                </div>
                <div class="form-group">
                    <label>{{__("Upload CCCD / CMT / Hộ chiếu / Giấy phép kinh doanh")}}</label>
                    <p>Nếu là doanh nghiệp , vui lòng upload Giấy phép kinh doanh</p>
                    <div class="upload-btn-wrapper">
                        <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        {{__("Browse")}}… <input type="file">
                                    </span>
                                </span>
                            <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view"
                                   readonly value="{{ get_file_url( old('file_agency',$user->file_agency) ) ?? $user->getAvatarUrl()?? __("No Image")}}">
                        </div>
                        <input type="hidden" class="form-control" name="file_agency" value="{{ old('file_agency',$user->file_agency)?? ""}}">
                        <img class="image-demo" src="{{ get_file_url( old('avatar_id',$user->file_agency) ) ??  $user->getAvatarUrl() ?? ""}}"/>
                    </div>
                </div>

                <div class="form-group">
                    <hr>
                    <input type="submit" class="btn btn-primary" value="{{__("Save changes")}}">
                    <a href="{{ route("user.profile.index") }}" class="btn btn-default">{{__("Cancel")}}</a>
                </div>

        </div>
        </div>
    </form>
    @else
        <div class="row">
            <div class="col-lg-6">
                <p style="color: #c00">Bạn đã trở thành đại lý tại Etrip Hunter</p>
                <p>Loại đại lý : <strong>{{($user->agency_type=='personal') ? 'Cá nhân' : 'Doanh nghiệp'}}</strong></p>
                <p>Mức chiết khấu : <strong>{{($user->agency_type=='personal') ? setting_item_with_lang('user_persional_percent') : setting_item_with_lang('user_company_percent') }} %</strong></p>
            </div>
        </div>
    @endif

    @endsection
