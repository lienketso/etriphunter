@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">Danh sách lịch trình : <strong style="color: #0b2e13">{{$tour->title}}</strong></h1>
            <div class="title-actions">
                <a href="{{route('tour.admin.schedule.create',$tour->id)}}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới lịch trình</a>
            </div>
        </div>
        @include('admin.message')
        @include('Language::admin.navigation')

        <div class="col-md-12">
            <div class="filter-div d-flex justify-content-between ">
                <div class="col-left">

                </div>
            </div>
            <div class="panel">
                <div class="row">
                    <div class="panel-body container-fluid">
                        <form action="" class="bravo-form-item">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th width="60px"><input type="checkbox" class="check-all"></th>
                                        <th width="200px"> Ngày khởi hành</th>
                                        <th width="150px"> Ngày về</th>
                                        <th width="150px"> Số chỗ</th>
                                        <th width="100px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!is_null($rows))
                                        @foreach($rows as $row)
                                            <tr>
                                                <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}">
                                                </td>
                                                <td class="title">{{showVNdate($row->start_date)}}</td>
                                                <td>{{showVNdate($row->end_date)}}</td>
                                                <td>{{$row->active}}</td>
                                                <td>
                                                    <a href="{{route('tour.admin.schedule.edit',$row->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">{{__("No data")}}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        {{$rows->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
        </div>
@endsection
