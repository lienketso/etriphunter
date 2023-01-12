<?php


namespace Modules\Booking\Models;


use App\BaseModel;
use Modules\User\Models\User;

class BookingRequest extends BaseModel
{
    protected $table = 'booking_request';
    protected $fillable = [
        'vendor_id',
        'name',
        'company',
        'office',
        'address',
        'email',
        'phone',
        'start_date',
        'end_date',
        'hotel',
        'vehicle',
        'persion',
        'total_guest',
        'description',
        'price',
        'commission',
        'commission_type',
        'create_user',
        'update_user',
        'location',
        'status'
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class,'vendor_id','id');
    }

}
