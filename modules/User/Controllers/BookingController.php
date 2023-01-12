<?php
namespace Modules\User\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Matrix\Exception;
use Modules\FrontendController;
use Modules\User\Events\NewVendorRegistered;
use Modules\User\Events\SendMailUserRegistered;
use Modules\User\Models\Newsletter;
use Modules\User\Models\Subscriber;
use Modules\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Modules\Vendor\Models\VendorRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Validator;
use Modules\Booking\Models\Booking;
use App\Helpers\ReCaptchaEngine;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Modules\Booking\Models\Enquiry;
use Modules\Privilege\Models\Privilege;

class BookingController extends FrontendController
{

    public function __construct()
    {
        parent::__construct();
    }


    public function bookingInvoice($code)
    {
        $booking = Booking::where('code', $code)->first();
        $user_id = Auth::id();
        if (empty($booking)) {
            return redirect('user/booking-history');
        }
        if ($booking->customer_id != $user_id and $booking->vendor_id != $user_id) {
            return redirect('user/booking-history');
        }
        $data = [
            'booking'    => $booking,
            'service'    => $booking->service,
            'page_title' => __("Invoice")
        ];
        return view('User::frontend.bookingInvoice', $data);
    }
    public function ticket($code = '')
    {
        $booking = Booking::where('code', $code)->first();
        $user_id = Auth::id();
        if (empty($booking)) {
            return redirect('user/booking-history');
        }
        if ($booking->customer_id != $user_id and $booking->vendor_id != $user_id) {
            return redirect('user/booking-history');
        }
        $data = [
            'booking'    => $booking,
            'service'    => $booking->service,
            'page_title' => __("Ticket")
        ];
        return view('User::frontend.booking.ticket', $data);
    }
    public function purchasePrivilege(Request $request)
    {
        if(!is_enable_guest_checkout() and !Auth::check()){
            return $this->sendError(__("You have to login in to do this"))->setStatusCode(401);
        }
        if(Auth::user() && !Auth::user()->hasVerifiedEmail() && setting_item('enable_verify_email_register_user')==1){
            return $this->sendError(__("You have to verify email first"), ['url' => url('/email/verify')]);
        }
        $privilege = Privilege::where('id',$request->id)->first();
        return $privilege->addToCart($request);
    }

}
