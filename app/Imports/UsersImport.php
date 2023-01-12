<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $check = Validator::make($row,[
            'name'=>'required',
            'email'=>Rule::unique('users'),
            'phone'=>Rule::unique('users')
        ])->validate();

        $user = new User([
            "name"=> $row['name'],
            "first_name" => $row['first_name'],
            "last_name" => $row['last_name'],
            "email" => $row['email'],
            "address" => $row['address'],
            "phone" => $row['phone'],
            "active_status" => 0,
            "password" => Hash::make('123456'),
            "privilege_id" => 1
        ]);

        //xóa role nếu đã tồn tại
        DB::table('core_model_has_roles')->where('model_id',$user->id)->delete();
        $role = Role::findById(2);
        $user->syncRoles($role);
        return $user;
    }
}
