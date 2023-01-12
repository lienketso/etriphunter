<?php
namespace Modules\Report\Admin;

use App\User;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Booking\Emails\NewBookingEmail;
use Modules\Booking\Events\BookingUpdatedEvent;
use Modules\Booking\Models\Booking;
use Modules\Tour\Models\Tour;
use Modules\Tour\Models\TourDate;

class BookingController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu(route('report.admin.booking'));
    }

    public function index(Request $request)
    {
        $this->checkPermission('booking_view');
        $query = Booking::where('status', '!=', 'draft');
        if (!empty($request->s)) {
            if( is_numeric($request->s) ){
                $query->Where('id', '=', $request->s);
            }else{
                $query->where(function ($query) use ($request) {
                    $query->where('first_name', 'like', '%' . $request->s . '%')
                        ->orWhere('last_name', 'like', '%' . $request->s . '%')
                        ->orWhere('email', 'like', '%' . $request->s . '%')
                        ->orWhere('phone', 'like', '%' . $request->s . '%')
                        ->orWhere('address', 'like', '%' . $request->s . '%')
                        ->orWhere('address2', 'like', '%' . $request->s . '%');
                });
            }
        }
        if ($this->hasPermission('booking_manage_others')) {
            if (!empty($request->vendor_id)) {
                $query->where('vendor_id', $request->vendor_id);
            }
        } else {
            $query->where('vendor_id', Auth::id());
        }
        $query->whereIn('object_model', array_diff( array_keys(get_bookable_services()), ['privilege'] ));
        $query->orderBy('id','desc');
        $data = [
            'rows'                  => $query->paginate(20),
            'page_title'            => __("All Bookings"),
            'booking_manage_others' => $this->hasPermission('booking_manage_others'),
            'booking_update'        => $this->hasPermission('booking_update'),
            'statues'               => config('booking.statuses')
        ];
        return view('Report::admin.booking.index', $data);
    }

    public function bulkEdit(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select action'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = Booking::where("id", $id);
                if (!$this->hasPermission('booking_manage_others')) {
                    $query->where("vendor_id", Auth::id());
                }
                $row = $query->first();
                if(!empty($row)){
                    $row->delete();
                    event(new BookingUpdatedEvent($row));

                }
            }
        } else {
            foreach ($ids as $id) {
                $query = Booking::where("id", $id);
                if (!$this->hasPermission('booking_manage_others')) {
                    $query->where("vendor_id", Auth::id());
                    $this->checkPermission('booking_update');
                }
                $item = $query->first();
                if(!empty($item)){
                    $item->status = $action;
                    $item->save();
                    if($action == Booking::CANCELLED) $item->tryRefundToWallet();
                    //nếu action là confirmed hoặc completed thì trừ số chỗ
                    if($action== Booking::CONFIRMED){
                        $tour = Tour::find($item->object_id);
                        //trừ đi slots ở tours_table
                        if($item->status!='confirmed') {
                            $tour->slots = $tour->slots - $item->total_guests;
                            $tour->save();
                            //trừ đi ở tour_date
                            $tourDate = TourDate::where('target_id', $tour->id)->whereDate('start_date', '=', dateSearch($item->start_date))->first();
                            if (!is_null($tourDate)) {
                                $tourDate->active = $tourDate->active - $item->total_guests;
                                $tourDate->save();
                            }
                        }

                    }
                    event(new BookingUpdatedEvent($item));
                }
            }
        }
        return redirect()->back()->with('success', __('Update success'));
    }

    public function acceptCommission($id){
        $row = Booking::find($id);
        $customer = User::find($row->customer_id);
        $percent_agency = 0;
        if($customer->agency_type=='personal'){
            $percent_agency = intval(setting_item('user_persional_percent'));
        }else{
            $percent_agency = intval(setting_item('user_company_percent'));
        }
        $agency_amount = $row->commission * ($percent_agency/100);
        return view('Report::admin.booking.accept-commission',compact('row','agency_amount','customer'));
    }
    public function postAcceptCommission(Request $request){
        $balance = $request->input('balance');
        $customerWallet = Wallet::where('holder_id',$request->input('customer_id'))->first();
        $customerWallet->balance += $balance;
        $customerWallet->save();
        $booking = Booking::find($request->input('id'));
        $booking->is_refund_wallet = 1;
        $booking->agency_amount = floatval($balance);
        $booking->save();
        return redirect()->route('report.admin.booking')->with('success','Xác nhận cộng hoa hồng cho đại lý thành công');
    }

    public function email_preview(Request $request, $id)
    {
        $booking = Booking::find($id);
        return (new NewBookingEmail($booking))->render();
    }
}
