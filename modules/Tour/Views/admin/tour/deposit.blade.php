@if(!empty($row->meta->deposit))
<div class="doposit-form">
    <div class="col-lg-6">
        <div class="form-group">
            <label class="control-label">Đặt cọc tối thiểu ( % )</label>
            <input type="hidden" name="enable_deposit" value="1">
            <input type="number" min="0" max="100" class="form-control" value="{{$row->meta->deposit['percent']}}" placeholder="10%" name="deposit[percent]">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label class="control-label">Thời hạn đặt cọc sau khi xác nhận đơn hàng</label>
            <div class="g-lang">
                <div class="title-lang">Tiếng Việt</div>
                <textarea class="form-control" rows="3"
                          placeholder="Đặt cọc trước 2 ngày sau khi xác nhận đơn hàng" name="deposit[date_duration]">{{$row->meta->deposit['date_duration']}}</textarea>
            </div>
            <div class="g-lang">
                <div class="title-lang">Tiếng Anh</div>
                <textarea class="form-control" rows="3" placeholder="" name="deposit[date_duration_en]">{{$row->meta->deposit['date_duration_en']}}</textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label class="control-label">Thời hạn thanh toán 100% trước ngày khởi hành</label>
            <div class="g-lang">
                <div class="title-lang">Tiếng Việt</div>
                <textarea class="form-control" rows="3" placeholder="Thanh toán trước 2 ngày trước ngày khởi hành" name="deposit[date_limited]">{{$row->meta->deposit['date_limited']}}</textarea>
            </div>
            <div class="g-lang">
                <div class="title-lang">Tiếng Anh</div>
                <textarea class="form-control" rows="3" placeholder="Thanh toán trước 2 ngày trước ngày khởi hành" name="deposit[date_limited_en]">{{$row->meta->deposit['date_limited_en']}}</textarea>
            </div>
        </div>
    </div>
</div>
    @else
    <div class="doposit-form">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label">Đặt cọc tối thiểu ( % )</label>
                <input type="number" min="0" max="100" class="form-control" value="" placeholder="10%" name="deposit[percent]">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="control-label">Thời hạn đặt cọc sau khi xác nhận đơn hàng</label>
                <div class="g-lang">
                    <div class="title-lang">Tiếng Việt</div>
                    <textarea class="form-control" rows="3"
                              placeholder="Đặt cọc trước 2 ngày sau khi xác nhận đơn hàng" name="deposit[date_duration]"></textarea>
                </div>
                <div class="g-lang">
                    <div class="title-lang">Tiếng Anh</div>
                    <textarea class="form-control" rows="3" placeholder="" name="deposit[date_duration_en]"></textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="control-label">Thời hạn thanh toán 100% trước ngày khởi hành</label>
                <div class="g-lang">
                    <div class="title-lang">Tiếng Việt</div>
                    <textarea class="form-control" rows="3" placeholder="Thanh toán trước 2 ngày trước ngày khởi hành" name="deposit[date_limited]"></textarea>
                </div>
                <div class="g-lang">
                    <div class="title-lang">Tiếng Anh</div>
                    <textarea class="form-control" rows="3" placeholder="Thanh toán trước 2 ngày trước ngày khởi hành" name="deposit[date_limited_en]"></textarea>
                </div>
            </div>
        </div>
    </div>
@endif
