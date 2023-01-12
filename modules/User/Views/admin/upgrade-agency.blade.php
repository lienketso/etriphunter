@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("Agency Requests")}}</h1>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">

        </div>
        <div class="text-right">
            <p><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></p>
        </div>
        <div class="panel">
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="60px"><input type="checkbox" class="check-all"></th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Phone')}}</th>
                                <th class="date">Loại đại lý</th>
                                <th>File</th>
                                <th>{{__('Approve')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($rows->total() > 0)
                                @foreach($rows as $row)
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="{{$row->id}}" class="check-item"></td>
                                        <td class="title">
                                            <a href="">{{$row->name}}</a>
                                        </td>
                                        <td>{{$row->email}}</td>
                                        <td>{{$row->phone}}</td>
                                        <td>{{($row->agency_type=='personal') ? 'Cá nhân' : 'Doanh nghiệp'}}</td>
                                        <td>
                                            <a href="{{get_file_url($row->file_agency,'thumb','')}}" target="_blank">Xem file</a>
                                        </td>
                                        <td>
                                            @if($row->is_agency!=1)
                                                <a class="btn btn-sm btn-info" href="{{route('user.admin.getUserAgency.upgrade',$row->id)}}">{{__('Approve')}}</a>
                                                @else
                                                <span>Đã xác nhận</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">{{__("No data")}}</td>
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
@endsection

@section('script.body')
    <script>
        $(document).ready(function () {
            $('.approve-user').click(function (e) {
                e.preventDefault();
                if(confirm('Are you sure approve?')){
                    ids = '<input type="hidden" name="ids[]" value="'+$(this).data('id')+'">';
                    form = $('.dungdt-apply-form-btn').closest('form');
                    form.append(ids);
                    form.find('select').val('approved');
                    form.submit();
                }
            })
        })
    </script>
@endsection
