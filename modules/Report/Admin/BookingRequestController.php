<?php


namespace Modules\Report\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\AdminController;
use Modules\Booking\Models\BookingRequest;
use Modules\User\Models\User;

class BookingRequestController extends AdminController
{
    protected $booking;
    public function __construct()
    {
        parent::__construct();
        $this->booking = BookingRequest::class;
        $this->setActiveMenu(route('report.admin.booking-request'));
    }

    public function index(Request $request){

        $this->checkPermission('booking_view');
        $query = BookingRequest::where('status','!=','draft');
        if (!empty($request->s)) {
            if( is_numeric($request->s) ){
                $query->Where('id', '=', $request->s)
                       ->orWhere('phone', 'like', '%' . $request->s . '%');
            }else{
                $query->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->s . '%')
                        ->orWhere('company', 'like', '%' . $request->s . '%')
                        ->orWhere('email', 'like', '%' . $request->s . '%')
                        ->orWhere('phone', 'like', '%' . $request->s . '%')
                        ->orWhere('address', 'like', '%' . $request->s . '%');
                });
            }
        }
        $query->orderBy('id','desc');
        $data = $query->paginate(10);
        return view('Report::admin.bookingrequest.index',compact('data'));
    }

    public function edit(Request $request,$id){
        $row = $this->booking::find($id);
        $vendors = User::where('is_vendor',1)->limit(20)->get();
        return view('Report::admin.bookingrequest.edit',compact('row','vendors'));
    }

    public function store(Request $request,$id){
        $input  = $request->all();
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
          'name.required'=>'Trường họ tên bắt buốc nhập',
          'phone.required'=>'Trường số điện thoại bắt buộc nhập',
          'start_date'=>'Vui lòng chọn ngày đi',
          'end_date'=>'Vui lòng chọn ngày về',
          'location.from_where'=>'Vui lòng chọn điểm đi',
          'location.to_where'=>'Vui lòng chọn điểm đến',
          'persion.adult.required'=>'Vui lòng nhập số lượng người lớn',
          'persion.adult.numeric'=>'Số lượng phải là kiểu số',
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
        $input['total_guest'] = $input['persion']['adult'] + $input['persion']['child'] + $input['persion']['young'] + $input['persion']['baby'];
        $input['persion'] = json_encode($input['persion']);
        $input['location'] = json_encode($input['location']);
        $input['commission_type'] = json_encode($input['commission']);
        $input['commission'] = $input['commission']['adult'] + $input['commission']['child'] + $input['commission']['young'] + $input['commission']['baby'];

        $row = $this->booking::find($id);
        if (empty($row)) {
            return redirect(route('report.admin.booking-request'));
        }
        $dataKeys = [
            'company','name','office','email','phone','address','start_date',
            'end_date','location','vehicle','hotel','persion','description','price',
            'commission','commission_type','status','vendor_id','total_guest'
        ];
        $row->fillByAttr($dataKeys,$input);
        $row->save();

        return redirect(route('report.admin.request-edit',$row->id))->with('success', __('Tour updated') );

    }

}
