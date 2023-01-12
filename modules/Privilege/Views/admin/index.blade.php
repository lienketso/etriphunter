@extends('admin.layouts.app')
@section('title','Privilege')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__("All Privileges")}}</h1>
            <div class="title-actions">
                <a href="{{route('privilege.admin.getcreate')}}" class="btn btn-primary">{{__("Add new Privilege")}}</a>
            </div>
        </div>
        @include('admin.message')
            <div class="col-md-12">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        @if(!empty($rows))
                            <form method="post" action="{{route('privilege.admin.bulkEdit')}}"
                                  class="filter-form filter-form-left d-flex justify-content-start">
                                {{csrf_field()}}
                                <select name="action" class="form-control">
                                    <option value="">{{__(" Bulk Actions ")}}</option>
                                    <option value="publish">{{__(" Publish ")}}</option>
                                    <option value="draft">{{__(" Move to Draft ")}}</option>
                                    <option value="delete">{{__(" Delete ")}}</option>
                                </select>
                                <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Apply')}}</button>
                            </form>
                        @endif
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
                                    <th width="200px"> {{ __('Name')}}</th>
                                    <th width="150px"> {{ __('Max Amount')}}</th>
                                    <th width="150px"> {{ __('Price')}}</th>
                                    <th width="100px"> {{ __('Discount')}}</th>
                                    <th width="100px"> {{ __('User')}}</th>
                                    <th width="100px"> {{ __('Status')}}</th>
                                    <th width="100px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!is_null($rows))
                                    @foreach($rows as $row)
                                        <tr>
                                            <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}">
                                            </td>
                                            <td class="title">{{$row->privilege_name}}</a></td>
                                            <td>{{$row->amount}}</td>
                                            <td>{{$row->price}}</td>
                                            <td>{{$row->discount}}</td>
                                            <td>{{$row->max_user}}</td>
                                            <td><span class="badge badge-{{ $row->status }}">{{ $row->status }}</span></td>
                                            <td>
                                                <a href="{{route('privilege.admin.detail',['id'=>$row->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
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
