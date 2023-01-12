<?php
namespace Modules\Vendor\Controllers;

use App\Helpers\ReCaptchaEngine;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;
use Matrix\Exception;
use Modules\Booking\Models\BookingRequest;
use Modules\Booking\Models\Service;
use Modules\Car\Models\Car;
use Modules\Company\Models\Company;
use Modules\Event\Models\Event;
use Modules\Flight\Models\Flight;
use Modules\FrontendController;
use Modules\Hotel\Models\Hotel;
use Modules\Tour\Models\Tour;
use Modules\User\Events\NewVendorRegistered;
use Modules\User\Events\SendMailUserRegistered;
use Modules\Vendor\Models\VendorRequest;
use Modules\Booking\Models\Booking;
use Spatie\Permission\Models\Role;


class VendorController extends FrontendController
{
    protected $bookingClass;
    protected $bookingRequest;
    public function __construct()
    {
        $this->bookingClass = Booking::class;
        $this->bookingRequest = BookingRequest::class;
        parent::__construct();
    }
    public function register(Request $request)
    {
        $rules = [
            'first_name' => [
                'required',
                'string',
                'max:255'
            ],
            'last_name'  => [
                'required',
                'string',
                'max:255'
            ],
            'business_name'  => [
                'required',
                'string',
                'max:255'
            ],
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'phone'      => [
                'required',
                'numeric',
                'unique:users'
            ],
            'password'   => [
                'required',
                'string'
            ],
            'term'       => ['required'],
        ];
        $messages = [
            'email.required'      => __('Email is required field'),
            'email.email'         => __('Email invalidate'),
            'password.required'   => __('Password is required field'),
            'first_name.required' => __('The first name is required field'),
            'last_name.required'  => __('The last name is required field'),
            'business_name.required'  => __('The business name is required field'),
            'term.required'       => __('The terms and conditions field is required'),
        ];
        if (ReCaptchaEngine::isEnable() and setting_item("user_enable_register_recaptcha")) {
            $messages['g-recaptcha-response.required'] = __('Please verify the captcha');
            $rules['g-recaptcha-response'] = ['required'];
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors()
            ], 200);
        } else {
            if (ReCaptchaEngine::isEnable() and setting_item("user_enable_register_recaptcha")) {
                $codeCapcha = $request->input('g-recaptcha-response');
                if (!ReCaptchaEngine::verify($codeCapcha)) {
                    $errors = new MessageBag(['message_error' => __('Please verify the captcha')]);
                    return response()->json([
                        'error'    => true,
                        'messages' => $errors
                    ], 200);
                }
            }
            $user = new \App\User();

            $user = $user->fill([
                'first_name'=>$request->input('first_name'),
                'last_name'=>$request->input('last_name'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
                'business_name'=>$request->input('business_name'),
                'phone'=>$request->input('phone'),
                'bio'=>$request->input('bio'),
                'file_agency'=>$request->input('file_agency'),
            ]);
            if($request->input('business_areas')){
                $business_areas = json_encode($request->input('business_areas'));
                $user->business_areas = $business_areas;
            }
            $user->status = 'publish';
            //mặc định vendor cũng là đại lý
            $user->is_agency = 1;
            $user->agency_type = 'company';
            $user->save();
            if (empty($user)) {
                return $this->sendError(__("Can not register"));
            }
            //Tạo đơn vị theo thông tin
            $company = new Company();
            $company = $company->fill([
               'name'=>$request->input('business_name'),
                'user_id'=>$user->id,
                'phone'=>$request->input('phone'),
                'email'=>$request->input('email'),
                'file_company'=>$request->input('file_agency'),
                'content'=>$request->input('bio')
            ]);
            $company->save();
            //update user company
            $user->company_id = $company->id;
            $user->save();

            //                check vendor auto approved
            $vendorAutoApproved = setting_item('vendor_auto_approved');
            $dataVendor['role_request'] = setting_item('vendor_role');
            if ($vendorAutoApproved) {
                if ($dataVendor['role_request']) {
                    $user->assignRole($dataVendor['role_request']);
                }
                $dataVendor['status'] = 'approved';
                $dataVendor['approved_time'] = now();
            } else {
                $dataVendor['status'] = 'pending';
                $user->assignRole('customer');
            }
            $vendorRequestData = $user->vendorRequest()->save(new VendorRequest($dataVendor));
            Auth::loginUsingId($user->id);
            try {
                event(new NewVendorRegistered($user, $vendorRequestData));
            } catch (Exception $exception) {
                Log::warning("NewVendorRegistered: " . $exception->getMessage());
            }
            if ($vendorAutoApproved) {
                return $this->sendSuccess([
                    'redirect' => url(app_get_locale(false, '/')),
                ]);
            } else {
                return $this->sendSuccess([
                    'redirect' => url(app_get_locale(false, '/')),
                ], __("Register success. Please wait for admin approval"));
            }
        }
    }

    public function bookingReport(Request $request)
    {
        $data = [
            'bookings'    => $this->bookingClass::getBookingHistory($request->input('status'), false, Auth::id()),
            'statues'     => config('booking.statuses'),
            'breadcrumbs' => [
                [
                    'name'  => __('Booking Report'),
                    'class' => 'active'
                ],
            ],
            'page_title'  => __("Booking Report"),
        ];
        return view('Vendor::frontend.bookingReport.index', $data);
    }

    public function bookingRequestReport(Request $request){
        $id = Auth::id();
        $status_type = $request->status;
        if($status_type){
            $bookings = $this->bookingRequest::where('vendor_id',$id)->where('status','processing')->paginate(10);
        }else{
            $bookings = $this->bookingRequest::where('vendor_id',$id)->where('status','vendor')->paginate(10);
        }
        return view('Vendor::frontend.bookingRequest.index',compact('bookings','status_type'));
    }

    public function bookingRequesUpdate(Request $request,$id){
        $row = $this->bookingRequest::where('id',$id)->first();
        if(empty($row)){
            return redirect()->back()->with(['message'=>'Không tồn tại tour này']);
        }
        return view('Tour::frontend.bookingRequest.upgrade',compact('row'));
    }

    public function upgrade(Request $request,$id){
        $input = $request->all();
        $rule = [
            'price'=>'required|numeric|min:0',
        ];
        $message = [
            'price.required'=>'Vui lòng nhập giá cho tour này',
            'price.numeric'=>'Giá phải là kiểu số',
            'price.min'=>'Giá phải lớn hơn hoặc bằng 0'
        ];
        $validate = Validator::make($input,$rule,$message);
        if ($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        }
        $row = $this->bookingRequest::find($id);
        $row->commission_type = json_encode($input['commission_type']);
        $row->commission = $input['commission_type']['adult'] + $input['commission_type']['child'] + $input['commission_type']['young'] + $input['commission_type']['baby'];
        $dataKeys = [
            'price','commission_type','status'
        ];
        $row->fillByAttr($dataKeys,$input);
        $row->save();
        return redirect()->route('vendor.bookingRequestUpdate',$row->id)->with(['success'=>'Bạn vừa cập nhật tour']);
    }

    public function profile($id){
        $vendor = User::find($id);
        if(!$vendor){
            return redirect(404);
        }
        $tours = Tour::where('create_user',$id)->where('status','publish')->paginate(100);
        $hotel = Hotel::where('create_user',$id)->where('status','publish')->paginate(100);
        $cars = Car::where('create_user',$id)->where('status','publish')->paginate(100);
        $flight = Flight::where('create_user',$id)->where('status','publish')->paginate(100);
        $utilities = Event::where('create_user',$id)->where('status','publish')->paginate(100);
        return view('Vendor::frontend.index',compact('vendor','tours','hotel','cars','flight','utilities'));
    }

    public function listUser(){
        $myId = Auth::id();
        $user = User::where('vendor_parent',$myId)->where('is_vendor',1)->paginate(20);
        return view('Vendor::frontend.users.index',compact('user'));
    }

    public function addUser(Request $request){
        $dataUser = new \Modules\User\Models\User();
        $data = [
            'dataUser' => $dataUser,
            'roles' => Role::all(),
            'breadcrumbs'=>[
                [
                    'name'=>__("Users"),
                    'url'=>route('vendor.list-user')
                ]
            ]
        ];
        return view('Vendor::frontend.users.detail',$data);
    }

    public function edit($id){
        $dataUser = User::find($id);
        if (empty($dataUser)) {
            return redirect(route('vendor.list-user'));
        }

        $data = [
            'dataUser'   => $dataUser,
            'roles' => Role::all(),
            'breadcrumbs'=>[
                [
                    'name'=>__("Users"),
                    'url'=>route('vendor.list-user')
                ],
                [
                    'name'=>__("Edit User: #:id",['id'=>$dataUser->id]),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Vendor::frontend.users.detail',$data);
    }

    public function store(Request $request, $id){
        $userLogin = Auth::user();
        $id = intval($id);
        if($id and $id>0){
            $row = User::find($id);
            if(empty($row)){
                abort(404);
            }
            $request->validate([
                'first_name'              => 'required|max:255',
                'last_name'              => 'required|max:255',
                'status'              => 'required|max:50',
                'phone'              => [
                    'required',
                    Rule::unique('users')->ignore($row->id)
                            ],
                'role_id'              => 'required|max:11',
                'email'              =>[
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($row->id)
                ],
                'user_name'=> [
                    'required',
                    'max:255',
                    'min:4',
                    'string',
                    'alpha_dash',
                    Rule::unique('users')->ignore($row->id)
                ],
            ]);

        }else{
            $check = Validator::make($request->input(),[
                'first_name'              => 'required|max:255',
                'last_name'              => 'required|max:255',
                'password'              =>'required|min:2',
                'status'              => 'required|max:50',
                'phone'              => [
                    'required',
                    Rule::unique('users')
                ],
                'role_id'              => 'required|max:11',
                'email'              =>[
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users')
                ],
                'user_name'=> [
                    'required',
                    'max:255',
                    'min:4',
                    'string',
                    'alpha_dash',
                    Rule::unique('users')
                ],
            ]);

            if(!$check->validated()){
                return back()->withInput($request->input());
            }
            $row = new User();
        }
        if($request->input('password') !=''){
            $row->password = Hash::make($request->input('password'));
        }
        $row->email = $request->input('email');
        $row->name = $request->input('name');
        $row->user_name = $request->input('user_name');
        $row->first_name = $request->input('first_name');
        $row->last_name = $request->input('last_name');
        $row->phone = $request->input('phone');
        $row->birthday = date("Y-m-d", strtotime($request->input('birthday')));
        $row->address = $request->input('address');
        $row->address2 = $request->input('address2');
        $row->bio = clean($request->input('bio'));
        $row->status = $request->input('status');
        $row->avatar_id = $request->input('avatar_id');
        $row->email = $request->input('email');
        $row->country = $request->input('country');
        $row->city = $request->input('city');
        $row->state = $request->input('state');
        $row->zip_code = $request->input('zip_code');
        $row->business_name = $request->input('business_name');
        $row->vendor_parent = $userLogin->id;
        $row->is_vendor = 1;
        $row->is_agency = 1;
        $row->agency_type = 'company';
        $row->file_agency = $userLogin->file_agency;
        $row->business_areas = json_encode($request->input('business_areas'));

        //Block all service when user is block
        if($row->status == "blocked"){
            $services = get_bookable_services();
            if(!empty($services)){
                foreach ($services as $service){
                    $service::query()->where("create_user",$row->id)->update(['status' => "draft"]);
                }
            }
        }

        if ($row->save()) {
            if ($request->input('role_id') and $role = Role::findById($request->input('role_id'))) {
                $row->syncRoles($role);
            }
            return back()->with('success', ($id and $id>0) ? __('User updated'):__("User created"));
        }
    }

}
