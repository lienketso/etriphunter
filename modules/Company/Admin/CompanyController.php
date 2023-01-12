<?php


namespace Modules\Company\Admin;
use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Company\Models\Company;
use Modules\User\Models\User;

class CompanyController extends AdminController
{
    public function index(){
        $rows = Company::orderBy('created_at','desc')->paginate(20);
        $data = [
            'rows'=>$rows,
            'breadcrumbs'        => [
                [
                    'name' => __('Đơn vị'),
                    'url'  => route('company.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>'Quản lý đơn vị'
        ];
        return view('Company::admin.index', $data);
    }
    public function create(){
        $row = new Company();
        $vendors = User::where('is_vendor',1)->get();
        $data = [
            'row'=>$row,
            'vendors'=>$vendors,
            'breadcrumbs'        => [
                [
                    'name' => 'Danh sách đơn vị',
                    'url'  => route('company.admin.index')
                ],
                [
                    'name'  => 'Thêm đơn vị',
                    'class' => 'active'
                ],
            ],
            'page_title'=> 'Thêm mới đơn vị'
        ];
        return view('Company::admin.create',$data);
    }

    public function edit($id){
        $row = Company::find($id);
        if (empty($row)) {
            return redirect(route('company.admin.index'));
        }
        $vendors = User::where('is_vendor',1)->get();
        $data = [
            'row'            => $row,
            'vendors'=>$vendors,
            'breadcrumbs'    => [
                [
                    'name' => 'Tất cả đơn vị',
                    'url'  => route('company.admin.index')
                ],
                [
                    'name' => __('Edit đơn vị: :name',['name'=>$row->name]),
                ],
            ],
            'page_title'=>__("Edit: :name",['name'=>$row->name]),
        ];
        return view('Company::admin.create', $data);
    }

    public function store(Request $request, $id){

        if($id>0){
            $row = Company::find($id);
            if (empty($row)) {
                return redirect(route('company.admin.index'));
            }
            $request->validate([
                'tax_id'=>[
                    'required',
                    'max:50',
                ],
                'name'=>['required'],
            ]);
        }else{
            $row = new Company();
            $request->validate([
                'tax_id'=>[
                    'required',
                    'max:50',
                    'unique:company'
                ],
                'name'=>['required'],
            ]);
        }

        $dataKeys = [
            'name',
            'tax_id',
            'phone',
            'email',
            'address',
            'logo',
            'file_company',
            'content'
        ];
        $row->fillByAttr($dataKeys,$request->input());
        $res = $row->save();
        if ($res) {

            if($id > 0 ){
                return redirect()->back()->with('success',  'Đã cập nhật đơn vị' );
            }else{
                return redirect()->to(route('company.admin.index'))->with('success',  'Đã tạo đơn vị' );
            }
        }
    }
}
