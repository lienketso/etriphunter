@extends('admin.layouts.app')

@section('content')
    <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">Import members</h1>
                </div>
            </div>
            @include('admin.message')
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title"><strong>{{ __('User Info')}}</strong>
                            <a href="{{public_path('storage/file-import-test.xlsx')}}" target="_blank">File import mẫu</a> </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("File excel import")}}</label>
                                        <input type="file" value="" name="file" placeholder="{{__("Chosen file excel")}}" class="form-control">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <span></span>
                <button class="btn btn-primary" type="submit">{{ __('Apply import')}}</button>
            </div>
        </div>
    </form>
    @endsection
