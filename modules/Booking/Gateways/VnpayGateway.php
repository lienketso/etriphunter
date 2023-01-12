<?php


namespace Modules\Booking\Gateways;


use Illuminate\Http\Request;
use Mockery\Exception;
use Modules\Booking\Models\Payment;
use Omnipay\Omnipay;

class VnpayGateway extends BaseGateway
{
    protected $gateway;
    public $name = 'Vnpay Payment';
    public $is_offline =  true;

    public function process(Request $request, $booking, $service)
    {
        $service->beforePaymentProcess($booking,$this);
        if (in_array($booking->status, [
            $booking::PAID,
            $booking::COMPLETED,
            $booking::CANCELLED
        ])) {

            throw new Exception(__("Booking status does need to be paid"));
        }
        if (!$booking->pay_now) {
            throw new Exception(__("Booking total is zero. Can not process payment gateway!"));
        }

        $vnp_Url = 'https://pay.vnpay.vn/vpcpay.html';
        $vnp_TmnCode = $this->getOption('TmnCode');
        $vnp_HashSecret = $this->getOption('client_secret');


        if ($this->getOption('test')) {
//            $this->gateway->setTestMode(true);
            $vnp_Url = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
            $vnp_TmnCode = $this->getOption('test_TmnCode');
            $vnp_HashSecret = $this->getOption('test_client_secret');
        }

        if($_SERVER['REMOTE_ADDR'] != null){
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        else{
            $ip = '103.226.248.106';
        }
        $vnp_Amount = floatval($booking->pay_now) * 100;
        $vnp_IpAddr = $ip;
        $vnp_Locale = 'vn';
        $vnp_OrderInfo = 'Thanh toan don hang #'.$booking->id;
        $vnp_TxnRef = $booking->id;
        $vnp_Returnurl = route('public.checkout.vnpay-return', [
            'token' => $booking->code
        ]);

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;

        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $payment = new Payment();
        $payment->booking_id = $booking->id;
        $payment->payment_gateway = $this->id;
        $payment->status = 'draft';
        $payment->amount = (float) $booking->pay_now;
        $booking->status = $booking::UNPAID;
        $booking->payment_id = $payment->id;
        $booking->save();
        return response()->json(['url'=>$vnp_Url ?? $booking->getDetailUrl()])->send();

    }

    public function getOptionsConfigs(){
        return [
            [
                'type'  => 'checkbox',
                'id'    => 'enable',
                'label' => __('Enable Vnpay Standard?')
            ],
            [
                'type'       => 'input',
                'id'         => 'name',
                'label'      => __('Custom Name'),
                'std'        => __("Vnpay"),
                'multi_lang' => "1"
            ],
            [
                'type'  => 'upload',
                'id'    => 'logo_id',
                'label' => __('Custom Logo'),
            ],
            [
                'type'  => 'editor',
                'id'    => 'html',
                'label' => __('Custom HTML Description'),
                'multi_lang' => "1"
            ],
            [
                'type'  => 'checkbox',
                'id'    => 'test',
                'label' => __('Enable Sandbox Mod?')
            ],
            [
                'type'      => 'input',
                'id'        => 'test_TmnCode',
                'label'     => __('Sandbox vnp_TmnCode'),
                'condition' => 'g_vnpay_test:is(1)'
            ],
            [
                'type'      => 'input',
                'id'        => 'test_client_secret',
                'label'     => __('Sandbox secretKey'),
                'condition' => 'g_vnpay_test:is(1)'
            ],
            [
                'type'      => 'input',
                'id'        => 'TmnCode',
                'label'     => __('API vnp_TmnCode'),
                'condition' => 'g_vnpay_test:is()'
            ],
            [
                'type'      => 'input',
                'id'        => 'client_secret',
                'label'     => __('API secretKey'),
                'condition' => 'g_vnpay_test:is()'
            ],
        ];
    }

    public function returnVnpayData($token){
        return $token; die();
    }

}
