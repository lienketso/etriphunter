<?php


namespace Modules\Company\Models;
use App\BaseModel;
use Modules\User\Models\User;

class Company extends BaseModel
{
    protected $table = 'company';
    protected $fillable = ['name','user_id','email','phone','tax_id','file_company','address','logo','content','create_user','update_user'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
