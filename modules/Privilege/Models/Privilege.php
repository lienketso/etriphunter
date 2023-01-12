<?php

namespace Modules\Privilege\Models;

use App\Models\User;
use App\User as AppUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Modules\Booking\Models\Bookable;
use Modules\Booking\Models\Booking;
use Illuminate\Http\Request;
use DateTime;
use DateInterval;

class Privilege extends Bookable{
    protected $table = 'privileges';
    protected $bookingClass;
    protected $fillable = [
        'privilege_name',
        'description',
        'amount',
        'discount',
        'max_user',
        'price',
        'image_id',
        'sort_order',
        'status'
    ];
    public $checkout_booking_detail_file       = 'Privilege::frontend/booking/detail';
    public $checkout_booking_detail_modal_file = 'Privilege::frontend/booking/detail-modal';
    public $set_paid_modal_file                = 'Privilege::frontend/booking/set-paid-modal';
    public $email_new_booking_file             = 'Privilege::emails.new_booking_detail';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->bookingClass = Booking::class;
    }
    public function users()
    {
        return $this->hasMany(User::class,'privilege_id','id');
    }
    public static function getModelName()
    {
        return __("Privilege");
    }
    public function isBookable()
    {
        if ($this->status != 'publish')
            return false;
        return parent::isBookable();
    }
    public function addToCartValidate(Request $request){
        $userpri = Auth::user()->privilege_id;
        $privilege = Privilege::where('id',$userpri)->first();
        $newpri = Privilege::where('id',$request->id)->first();
        if($privilege){
        if($privilege->price >= $newpri->price){
            return redirect()->back()->with('error', __('Privilege cannot be selected'));
        }
        }
        return true;
    }
    public function addToCart(Request $request)
    {
        $res = $this->addToCartValidate($request);
        if($res !== true) return $res;
        $startdate = new DateTime();
        $enddate = new DateTime() ;
        $enddate -> add(new DateInterval('P30D'));
        // Add Booking

        $booking = new $this->bookingClass();
        $booking->status = 'draft';
        $booking->object_id = $request->id;
        $booking->object_model = 'privilege';
        $booking->vendor_id = null;
        $booking->customer_id = Auth::id();
        $booking->total = $this->price;
        $booking->total_guests = 1;

        $booking->start_date = $startdate;



        $booking->end_date = $enddate ;

        $booking->vendor_service_fee_amount = null;
        $booking->vendor_service_fee = null;
        $booking->buyer_fees = null;

        $booking->commission = 0;
        $booking->commission_type = '{"adult":"0","child":"0","young":"0","baby":"0"}';
        $booking->number = 1;
        $check = $booking->save();
        if ($check) {

            $this->bookingClass::clearDraftBookings();

            $booking->addMeta('base_price', $this->tmp_price);
            $booking->addMeta('extra_price', 0);
             return redirect()->route('booking.checkout',['code'=>$booking->code]);
            //  return $this->sendSuccess([
            //      'url' => $booking->getCheckoutUrl(),
            //      'booking_code' => $booking->code,
            //  ]);

        }
        return $this->sendError(__("Can not check availability"));
    }


}
