@extends('Email::layout')
@section('content')
    <div class="b-container">
        <div class="b-panel">
            <h3>Chào bạn, {{$details['name']}}</h3>
            <p>Tour du lịch mà bạn đăng ký sắp đến ngày khởi hành, kính mời bạn liên lạc và gửi tiền đặt cọc cho chúng tôi, để chúng tôi có thể chuẩn bị thật tốt cho chuyến đi </p>
            <p><strong>Thank you</strong></p>
        </div>
    </div>
@endsection
