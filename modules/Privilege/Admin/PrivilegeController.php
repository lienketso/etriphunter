<?php
namespace Modules\Privilege\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Privilege\Models\Privilege;
use App\User;
use Modules\Booking\Models\Booking;

class PrivilegeController extends AdminController
{


    public function index(Request $request){
        $this->checkPermission('privilege_view');
        $rows = Privilege::paginate(20);
        $data = [
            'rows'               => $rows,
            'breadcrumbs'        => [
                [
                    'name' => __('Privilege'),
                    'url'  => route('privilege.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Privilege Management")
        ];
        return view('Privilege::admin.index', $data);

    }
    public function getcreate(Request $request){
        $this->checkPermission('privilege_create');
        $data = [
            'breadcrumbs'        => [
                [
                    'name' => __('Privilege'),
                    'url'  => route('privilege.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Create Privilege")
        ];
        return view('Privilege::admin.create', $data);
    }
    public function getedit(Request $request){
        $this->checkPermission('privilege_update');
        $id=$request->id;
        $privilege= Privilege::where('id', $id)->firstOrFail();

         $data = [
            'privilege'          => $privilege,
            'id'                 => $id,
            'breadcrumbs'        => [
                [
                    'name' => __('Privilege'),
                    'url'  => route('privilege.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("Privilege Edit")
        ];
        return view('Privilege::admin.detail', $data);
    }
    public function viewuser(Request $request){
        $this->checkPermission('privilege_view');
        $privilege=User::has('privilege')->orderBy('Privilege_available','asc');
        $data = [
            'data'               =>$privilege->paginate(20),
            'breadcrumbs'        => [
                [
                    'name' => __('Privilege'),
                    'url'  => route('privilege.admin.index')
                ],
                [
                    'name'  => __('User'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("User Privilege Management")
        ];
        return view('Privilege::admin.user',$data);
    }


    public function postedit(Request $request){
        $this->checkPermission('privilege_update');
        $id=$request->id;
        $privilege= Privilege::where('id', $id)->firstOrFail();
        $privilege->privilege_name = $request->privilege_name;
        $privilege->discount = $request->discount;
        $privilege->amount = $request->amount;
        $privilege->description = $request->description;
        $privilege->max_user = $request->max_user;
        $privilege->status = $request->status;
        $privilege->price = $request->price;
        $privilege->image_id = $request->image_id;
        $privilege->sort_order = $request->sort_order;
        $privilege->count = $request->count;
        $privilege->save();
        return redirect(route('privilege.admin.index'))->with('success',  __('Privilege updated') );
    }

    public function postcreate(Request $request){
        $this->checkPermission('privilege_create');
        $privilege= new Privilege();
        $privilege->privilege_name = $request->privilege_name;
        $privilege->discount = $request->discount;
        $privilege->amount = $request->amount;
        $privilege->description = $request->description;
        $privilege->max_user = $request->max_user;
        $privilege->status = $request->status;
        $privilege->price = $request->price;
        $privilege->image_id = $request->image_id;
        $privilege->sort_order = $request->sort_order;
        $privilege->count = $request->count;
        $privilege->save();

        return redirect(route('privilege.admin.index'))->with('success',  __('Privilege created') );
    }
    public function userdetail(Request $request){
        $this->checkPermission('privilege_view');
        $id=$request->id;
        $user= User::where('id', $id)->firstOrFail();
        $privileges= Privilege::all();

        $data = [
            'user'          => $user,
            'id'                 => $id,
            'privileges'     =>$privileges,
            'breadcrumbs'        => [
                [
                    'name' => __('Privilege'),
                    'url'  => route('privilege.admin.index')
                ],
                [
                    'name'  => __('User Privilege Edit'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__("User Privilege Edit")
        ];
        return view('Privilege::admin.userdetail', $data);

    }


    public function useredit(Request $request){
        $this->checkPermission('privilege_update');
        $id=$request->id;
        $user= User::where('id', $id)->firstOrFail();
        $user->privilege_id=$request->privilege_id;
        $user->privilege_available=$request->privilege_available;
        $user->privilege_amount=$request->privilege_amount;
        $user->privilege_count=$request->privilege_count;
        $user->save();
        return redirect(route('privilege.admin.user'))->with('success',  __('User updated') );

    }
    public function bulkEdit(Request $request)
    {
        $this->checkPermission('privilege_update');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('No items selected!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Please select an action!'));
        }
        if ($action == "delete") {
            $this->checkPermission('privilege_delete');
            foreach ($ids as $id) {
                $query = Privilege::where("id", $id);
                $query->first();
                $users = User::where("privilege_id", $id)->get();
                if(!empty($query)){
                    $query->delete();
                }
                foreach($users as  $user){
                    $user->privilege_id=null;
                    $user->privilege_available=null;
                    $user->save();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = Privilege::where("id", $id);
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Update success!'));
    }

    public function upgradereqest(Request $request)
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
        $query->where('object_model', 'privilege');
        $query->orderBy('id','desc');
        $data = [
            'privileges'            => Privilege::all(),
            'rows'                  => $query->paginate(20),
            'page_title'            => __("Privilege upgrade request"),
            'booking_manage_others' => $this->hasPermission('booking_manage_others'),
            'booking_update'        => $this->hasPermission('booking_update'),
            'statues'               => config('booking.statuses')
        ];
        return view('Privilege::admin.upgraderequest', $data);
    }



}
