@php
    use Modules\Privilege\Models\Privilege;
    use App\User;
    $user=User::where('id',$booking->customer_id)->first();
    if(!is_enable_guest_checkout()){
        $privilege= Privilege::where('id',$user->privilege_id)->first();
    }

@endphp
@if (!is_enable_guest_checkout())
@if (new DateTime($user->privilege_available) >= new DateTime('now') && $privilege->status == 'publish')
<li class="d-flex flex-column border-0 mb-0 mt-2">
    <div class="section-coupon-form">
            <ul class="p-0 mb-3 list-coupons ">
                    <li class="item d-flex justify-content-between py-2">
                        <div class="label">
                            {{ $privilege->privilege_name }}
                            @if ($privilege->description)
                            <i data-toggle="tooltip" data-placement="top" class="icofont-info-circle" data-original-title="{{ $privilege->description }}"></i>
                            @endif
                        </div>
                        <div class="val">
                            {{-- @php
                            if($booking->privilege_amount){
                                $amount=$booking->privilege_amount;
                            }
                            else {
                                if(($booking->total)*($privilege->discount)/100 < $privilege->amount ){
                                $amount=($booking->total)*($privilege->discount)/100;
                            }
                            else{
                                $amount=$privilege->amount;
                            }
                            }

                            @endphp --}}
                            -{{format_money($booking->privilege_amount)}}
                        </div>
                    </li>
            </ul>
        <div class="message alert-text mt-2"></div>
    </div>
</li>
@endif
@endif
