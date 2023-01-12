<?php


namespace Modules\Api\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Booking\Models\Booking;
use Modules\Vendor\Models\VendorRequest;

class ReportController extends Controller
{
    public function __construct()
    {
    }
    public static $notAcceptedStatus = [
        'draft','cancelled','unpaid'
    ];
    public function getReport(Request $request){
        $userVendor = VendorRequest::with(['user'])
            ->where('role_request',1)
            ->where('status','approved')
            ->count();
        $services = get_bookable_services();
        $total_service = 0;
        if(!empty($services))
        {
            foreach ($services as $service){
                $total_service += $service::where('status', 'publish')->count('id');
            }
        }
        $total_booking = Booking::whereNotIn('status',static::$notAcceptedStatus)->count('id');
        $total_booking_completed = Booking::where('status','completed')->count('id');
        $total_booking_canceled = Booking::where('status','cancelled')->count('id');
        $total_data = Booking::selectRaw('sum(`total`) as total_price , sum( `total` - `total_before_fees` + `commission` - `vendor_service_fee_amount` ) AS total_earning ')
            ->whereNotIn('status',static::$notAcceptedStatus)
            ->first();
        $data = [
            'soLuongTruyCap'=>0,
            'soNguoiBan'=>$userVendor,
            'soNguoiBanMoi'=>0,
            'tongSoSanPham'=>$total_service,
            'soSanPhamMoi'=>0,
            'soLuongGiaoDich'=>$total_booking,
            'tongSoDonHangThanhCong'=>$total_booking_completed,
            'tongSoDongHangKhongThanhCong'=>$total_booking_canceled,
            'tongGiaTriGiaoDich'=>$total_data->total_price
        ];
        return json_encode($data);
    }
}
