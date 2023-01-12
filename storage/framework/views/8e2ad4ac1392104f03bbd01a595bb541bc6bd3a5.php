<?php
    use Modules\Privilege\Models\Privilege;
    use App\User;
    $user=User::where('id',$booking->customer_id)->first();
    if(!is_enable_guest_checkout()){
        $privilege= Privilege::where('id',$user->privilege_id)->first();
    }

?>
<?php if(!is_enable_guest_checkout()): ?>
<?php if(new DateTime($user->privilege_available) >= new DateTime('now') && $privilege->status == 'publish'): ?>
<li class="d-flex flex-column border-0 mb-0 mt-2">
    <div class="section-coupon-form">
            <ul class="p-0 mb-3 list-coupons ">
                    <li class="item d-flex justify-content-between py-2">
                        <div class="label">
                            <?php echo e($privilege->privilege_name); ?>

                            <?php if($privilege->description): ?>
                            <i data-toggle="tooltip" data-placement="top" class="icofont-info-circle" data-original-title="<?php echo e($privilege->description); ?>"></i>
                            <?php endif; ?>
                        </div>
                        <div class="val">
                            
                            -<?php echo e(format_money($booking->privilege_amount)); ?>

                        </div>
                    </li>
            </ul>
        <div class="message alert-text mt-2"></div>
    </div>
</li>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\etrip\themes/Mytravel/Privilege/Views/frontend/booking/checkout.blade.php ENDPATH**/ ?>