<?php


namespace Modules\Booking\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Booking\Models\BookingRequest;
use Telegram\Bot\Laravel\Facades\Telegram;

class BookingRequestController extends Controller
{
    protected $booking;
    public function __construct()
    {
        $this->booking = BookingRequest::class;
    }

    public function createBooking(Request $request){
        $input = $request->all();
        $rule = [
          'name'=>'required',
          'phone'=>'required',
          'start_date'=>'required',
          'end_date'=>'required',
          'location.from_where'=>'required',
          'location.to_where'=>'required',
          'persion.adult'=>'required|numeric|min:1'
        ];
        $message = [
          'name.required'=>'Trường tên bắt buộc nhập',
          'phone.required'=>'Trường số điện thoại bắt buộc nhập',
          'start_date.required'=>'Bạn chưa chọn ngày đi',
          'end_date.required'=>'Bạn chưa chọn ngày về',
          'location.from_where.required'=>'Bạn chưa nhập điểm đi',
          'location.to_where.required'=>'Bạn chưa nhập điểm đến',
          'persion.adult.required'=>'Bạn chưa nhập số lượng người lớn',
          'persion.adult.numeric'=>'Số lượng người lớn phải là kiểu số',
          'persion.adult.min'=>'Số lượng người lớn phải lớn hơn 0'
        ];
        $validate = Validator::make($input,$rule,$message);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        }
        $input['start_date'] = getInputDatefomat($input['start_date']);
        $input['end_date'] = getInputDatefomat($input['end_date']);
        if(!empty($input['vehicle'])){
            $input['vehicle'] = json_encode($input['vehicle']);
        }
        $totalGuest = $input['persion']['adult'] + $input['persion']['child'] + $input['persion']['young'] + $input['persion']['baby'];
        $input['persion'] = json_encode($input['persion']);
        $input['location'] = json_encode($input['location']);
        $row = new $this->booking($input);
        $row->total_guest = intval($totalGuest);
        $row->save();
        $text = "Thông báo tour theo yêu cầu mới được đặt : #YEUCAU".$row->id."\n";
        $text .= "Ngày đăng ký : <b>".showVNdate($row->created_at)."</b>\n";
        $text .= "Người liên hệ : <b>".$row->name ."</b>\n";
        $text .= "Số điện thoại : <b>".$row->phone ."</b>\n";
        $text .= "Ngày đi : <b>".showVNdate($row->start_date) ."</b>\n";
        $text .= "Ngày về : <b>".showVNdate($row->end_date) ."</b>\n";
        $location = json_decode($row->location);
        $text .= "Địa điểm đi : <b>".$location->from_where."</b>\n";
        $text .= "Địa điểm đến : <b>".$location->to_where ."</b>\n";
        $text .= "Số lượng khách : <b>".$row->total_guest."</b>\n";
        if($row->vendor_id!=0){
            $vendor = $row->vendor->name;
        }else{
            $vendor = "Chưa chọn nhà cung cấp dịch vụ";
        }
        $text .= "Nhà cung cấp : <b>".$vendor."</b>\n";
        $text .= "Chi tiết đăng nhập : <b>".env('APP_URL', '')."</b>\n";
        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);
        return view('Booking::frontend/booking.request-success',['data'=>$row]);
    }

}
