<?php


namespace Modules\Booking\Controllers;


use Illuminate\Http\Request;
use Modules\Booking\Events\BookingCreatedEvent;
use Modules\Booking\Models\Booking;

class NormalCheckoutController extends BookingController
{
    public function showInfo(){
        return view("Booking::frontend.normal-checkout.info");
    }
    public function VnpayReturn(Request $request){
        $secret = setting_item('g_vnpay_client_secret');
        if(setting_item('g_vnpay_test')==1){
            $secret = setting_item('g_vnpay_test_client_secret');
        }
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        $secureHash = hash_hmac('sha512', $hashData, $secret);
        $status = 'error';
        $message = 'Thanh toán đơn hàng không thành công';
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $status = 'success';
                $message = 'Thanh toán đơn hàng thành công';
            } else {
                $message = 'Thanh toán đơn hàng không thành công';
            }
        }
        $token = $request->token;
        $booking = Booking::where('code',$token)->first();
        if(!empty($booking)){
            event(new BookingCreatedEvent($booking));
            return redirect($booking->getDetailUrl());
        }else{
            return view("Booking::frontend.normal-checkout.vnpay-return",compact('status','message'));
        }

    }
    public function confirmPayment(Request $request, $gateway)
    {
        $gateways = get_payment_gateways();
        if (empty($gateways[$gateway]) or !class_exists($gateways[$gateway])) {
            return $this->sendError(__("Payment gateway not found"));
        }
        $gatewayObj = new $gateways[$gateway]($gateway);
        if (!$gatewayObj->isAvailable()) {
            return $this->sendError(__("Payment gateway is not available"));
        }
        $res = $gatewayObj->confirmNormalPayment($request);
        $status = $res[0] ?? null;
        $message = $res[1] ?? null;
        $redirect_url = $res[2] ?? null;

        if(empty($redirect_url)) $redirect_url = route('gateway.info');

        return redirect()->to($redirect_url)->with($status ? "success" : "error",$message);

    }

    public function sendError($message, $data = [])
    {
        return  redirect()->to(route('gateway.info'))->with('error',$message);
    }

    public function cancelPayment(Request $request, $gateway)
    {

        $gateways = get_payment_gateways();
        if (empty($gateways[$gateway]) or !class_exists($gateways[$gateway])) {
            return $this->sendError(__("Payment gateway not found"));
        }
        $gatewayObj = new $gateways[$gateway]($gateway);
        if (!$gatewayObj->isAvailable()) {
            return $this->sendError(__("Payment gateway is not available"));
        }
        $res =  $gatewayObj->cancelNormalPayment($request);
        $status = $res[0] ?? null;
        $message = $res[1] ?? null;
        $redirect_url = $res[2] ?? null;

        if(empty($redirect_url)) $redirect_url = route('gateway.info');

        return redirect()->to($redirect_url)->with($status ? "success" : "error",$message);
    }
}
