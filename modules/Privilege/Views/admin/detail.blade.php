@extends('admin.layouts.app')

@section('content')
    <form action="{{route('privilege.admin.postedit',['id'=>$id ?? -1])}}" method="post" class="needs-validation" novalidate>
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$privilege->privilege_name}}</h1>
                </div>
            </div>

            @include('admin.message')
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title"><strong>{{ __('Privilege')}}</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Privilege name")}}</label>
                                        <input type="text" value="{{$privilege->privilege_name}}" name="privilege_name" placeholder="{{__("Privilege_name")}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Discount')}}</label>
                                        <input type="text" required value="{{$privilege->discount}}" placeholder="{{ __('Discount')}}" name="discount" class="form-control"  >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Amount")}}</label>
                                        <input type="text" name="amount" required value="{{$privilege->amount}}" placeholder="{{__("Amount")}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Max User")}}</label>
                                        <input type="text" name="max_user" required value="{{$privilege->max_user}}" placeholder="{{__("Max User")}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Price")}}</label>
                                        <input type="text" name="price" required value="{{$privilege->price}}" placeholder="{{__("Price")}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Count")}}</label>
                                        <input type="text" name="count" required value="" placeholder="{{__("Count")}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__("Description")}}</label>
                                        <textarea name="description" class="d-none has-ckeditor" placeholder="{{__("Description")}}" cols="30" rows="10">{{$privilege->description}}</textarea>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-3">
                        <div class="panel">
                           <div class="panel-title"><strong>{{ __('Publish')}}</strong></div>
                           <div class="panel-body">
                               <div class="form-group">
                                   <label>{{__('Status')}}</label>
                                   <select required class="custom-select" name="status">
                                       <option  value="publish">{{ __('Publish')}}</option>
                                       <option  value="draft">{{ __('Draft')}}</option>
                                   </select>
                               </div>
                           </div>
                       </div>
                        <div class="panel">
                            <div class="panel-title"><strong>{{ __('Sort order')}}</strong></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="number" min="0" placeholder="Th??? t??? ??u ti??n" name="sort_order" class="form-control" value="{{$privilege->sort_order}}">
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-body">
                                <h3 class="panel-body-title"> {{ __('Feature Image')}}</h3>
                                <div class="form-group">
                                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$privilege->image_id) !!}
                                </div>
                            </div>
                        </div>
                       <div class="d-flex justify-content-between">
                           <span></span>
                           <button class="btn btn-primary" type="submit">{{ __('Save Change')}}</button>
                       </div>
                   </div>
            </div>
    </form>

@endsection
@section ('script.body')
@endsection
