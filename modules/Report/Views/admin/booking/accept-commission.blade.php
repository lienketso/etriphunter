@extends('admin.layouts.app')
@section('content')
    <form action="{{route('report.admin.post-accept-commission')}}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">Xác nhận cộng tiền hoa hồng cho đại lý</h1>
                </div>
                <div class="">

                </div>
            </div>
    @include('admin.message')
            <input type="hidden" name="customer_id" value="{{$customer->id}}">
            <input type="hidden" name="id" value="{{$row->id}}">
            <div class="lang-content-box">
                <p>Tổng tiền hoa hồng nhận từ Vendor : <strong>{{format_money_main($row->commission)}}</strong></p>
                <p>Hoa hồng đại lý : <strong>{{format_money_main($agency_amount)}}</strong></p>
               <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Hoa hồng phải trả cho đại lý</label>
                        <input type="text" name="balance" class="form-control" value="{{$agency_amount}}" readonly>
                    </div>
                    <p style="font-style: italic">Bằng việc click xác nhận bên dưới, hoa hồng được cộng vào ví của đại lý *</p>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Xác nhận</button>
                    </div>
                </div>
               </div>
            </div>

        </div>
    </form>

@endsection
