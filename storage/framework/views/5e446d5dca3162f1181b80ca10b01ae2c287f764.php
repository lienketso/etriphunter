<?php
use Modules\Privilege\Models\Privilege;
$dataUser=Auth::user();
$menus = [
    'dashboard'       => [
        'url'        => route("vendor.dashboard"),
        'title'      => __("Dashboard"),
        'icon'       => 'fa fa-home',
        'permission' => 'dashboard_vendor_access',
        'position'   => 10
    ],
    'booking-history' => [
        'url'      => route("user.booking_history"),
        'title'    => __("Booking History"),
        'icon'     => 'fa fa-clock-o',
        'position' => 20
    ],
    "wishlist"=>[
        'url'   => route("user.wishList.index"),
        'title' => __("Wishlist"),
        'icon'  => 'fa fa-heart-o',
        'position' => 21
    ],
    'profile'         => [
        'url'      => route("user.profile.index"),
        'title'    => __("My Profile"),
        'icon'     => 'fa fa-cogs',
        'position' => 40
    ],
    'password'        => [
        'url'      => route("user.change_password"),
        'title'    => __("Change password"),
        'icon'     => 'fa fa-lock',
        'position' => 50
    ],
    'admin'           => [
        'url'        => route('admin.index'),
        'title'      => __("Admin Dashboard"),
        'icon'       => 'icon ion-ios-ribbon',
        'permission' => 'dashboard_access',
        'position'   => 60
    ]
];

// Modules
$custom_modules = \Modules\ServiceProvider::getModules();
if(!empty($custom_modules)){
    foreach($custom_modules as $module){
        $moduleClass = "\\Modules\\".ucfirst($module)."\\ModuleProvider";
        if(class_exists($moduleClass))
        {
            $menuConfig = call_user_func([$moduleClass,'getUserMenu']);
            if(!empty($menuConfig)){
                $menus = array_merge($menus,$menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass,'getUserSubMenu']);
            if(!empty($menuSubMenu)){
                foreach($menuSubMenu as $k=>$submenu){
                    $submenu['id'] = $submenu['id'] ?? '_'.$k;
                    if(!empty($submenu['parent']) and isset($menus[$submenu['parent']])){
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                            return $value['position'] ?? 100;
                        }));
                    }
                }
            }
        }
    }
}

// Plugins Menu
$plugins_modules = \Plugins\ServiceProvider::getModules();
if(!empty($plugins_modules)){
    foreach($plugins_modules as $module){
        $moduleClass = "\\Plugins\\".ucfirst($module)."\\ModuleProvider";
        if(class_exists($moduleClass))
        {
            $menuConfig = call_user_func([$moduleClass,'getUserMenu']);
            if(!empty($menuConfig)){
                $menus = array_merge($menus,$menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass,'getUserSubMenu']);
            if(!empty($menuSubMenu)){
                foreach($menuSubMenu as $k=>$submenu){
                    $submenu['id'] = $submenu['id'] ?? '_'.$k;
                    if(!empty($submenu['parent']) and isset($menus[$submenu['parent']])){
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                            return $value['position'] ?? 100;
                        }));
                    }
                }
            }
        }
    }
}

// Custom Menu
$custom_modules = \Custom\ServiceProvider::getModules();
if(!empty($custom_modules)){
    foreach($custom_modules as $module){
        $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
        if(class_exists($moduleClass))
        {
            $menuConfig = call_user_func([$moduleClass,'getUserMenu']);
            if(!empty($menuConfig)){
                $menus = array_merge($menus,$menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass,'getUserSubMenu']);
            if(!empty($menuSubMenu)){
                foreach($menuSubMenu as $k=>$submenu){
                    $submenu['id'] = $submenu['id'] ?? '_'.$k;
                    if(!empty($submenu['parent']) and isset($menus[$submenu['parent']])){
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                            return $value['position'] ?? 100;
                        }));
                    }
                }
            }
        }
    }
}

$currentUrl = url(Illuminate\Support\Facades\Route::current()->uri());
if (!empty($menus))
    $menus = array_values(\Illuminate\Support\Arr::sort($menus, function ($value) {
        return $value['position'] ?? 100;
    }));
    foreach ($menus as $k => $menuItem) {
        if (!empty($menuItem['permission']) and !Auth::user()->hasPermissionTo($menuItem['permission'])) {
            unset($menus[$k]);
            continue;
        }
        $menus[$k]['class'] = $currentUrl == url($menuItem['url']) ? 'active' : '';
        if (!empty($menuItem['children'])) {
            $menus[$k]['class'] .= ' has-children';
            foreach ($menuItem['children'] as $k2 => $menuItem2) {
                if (!empty($menuItem2['permission']) and !Auth::user()->hasPermissionTo($menuItem2['permission'])) {
                    unset($menus[$k]['children'][$k2]);
                    continue;
                }
                $menus[$k]['children'][$k2]['class'] = $currentUrl == url($menuItem2['url']) ? 'active active_child' : '';
            }
        }
    }
?>
<style type="text/css">
    .btn-become-daily{
        padding: 10px 20px;
        background: #297cbb;
        color: #fff;
        border-radius: 5px;
    }
    .btn-become-daily:hover{
        background: #00afea;
        text-decoration: none;
        color: #fff;
    }
    .btn-setting-user{
        padding-top: 30px;
        text-align: center;
    }
</style>
<div class="sidebar-user">
    <div class="bravo-close-menu-user"><i class="icofont-scroll-left"></i></div>
    <div class="logo">
        <?php if($avatar_url = $dataUser->getAvatarUrl()): ?>
            <div class="avatar avatar-cover" style="background-image: url('<?php echo e($dataUser->getAvatarUrl()); ?>')"></div>
        <?php else: ?>
            <span class="avatar-text"><?php echo e(ucfirst($dataUser->getDisplayName()[0])); ?></span>
        <?php endif; ?>
    </div>
    <div class="user-profile-avatar">
        <div class="info-new">
            <span class="role-name badge badge-info"><?php echo e($dataUser->role_name); ?></span>
            <h5><?php echo e($dataUser->getDisplayName()); ?></h5>
            <?php if($dataUser->privilege_id): ?>
            <?php
            $pre = new Privilege();
            $preInfo = $pre->where('id',$dataUser->privilege_id)->first();
            ?>
            <?php if(  new DateTime($dataUser->privilege_available) >= new DateTime('now') && $preInfo->status == 'publish'): ?>
            <h5><?php echo e($preInfo->privilege_name); ?></h5>
            <?php endif; ?>
            <?php endif; ?>
            <p><?php echo e(__("Member Since :time",["time"=> date("M Y",strtotime($dataUser->created_at))])); ?></p>

        </div>
        <div class="btn-setting-user">
            <a class="btn-become-daily" href=" <?php echo e(route("user.become_agency")); ?>"><i class="fa fa-handshake-o"></i> Trở thành đại lý</a>
        </div>
    </div>
    <div class="user-profile-plan">
        <?php if( !Auth::user()->hasPermissionTo("dashboard_vendor_access") and setting_item('vendor_enable')): ?>
            <a href=" <?php echo e(route("user.upgrade_vendor")); ?>"><?php echo e(__("Become a vendor")); ?></a>
        <?php endif; ?>
    </div>
    <div class="sidebar-menu">
        <ul class="main-menu">
            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="<?php echo e($menuItem['class']); ?>">
                    <a href="<?php echo e(url($menuItem['url'])); ?>">
                        <?php if(!empty($menuItem['icon'])): ?>
                            <span class="icon text-center"><i class="<?php echo e($menuItem['icon']); ?>"></i></span>
                        <?php endif; ?>
                        <?php echo clean($menuItem['title']); ?>


                    </a>
                    <?php if(!empty($menuItem['children'])): ?>
                        <i class="caret"></i>
                    <?php endif; ?>
                    <?php if(!empty($menuItem['children'])): ?>
                        <ul class="children">
                            <?php $__currentLoopData = $menuItem['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php echo e($menuItem2['class']); ?>"><a href="<?php echo e(url($menuItem2['url'])); ?>">
                                        <?php if(!empty($menuItem2['icon'])): ?>
                                            <i class="<?php echo e($menuItem2['icon']); ?>"></i>
                                        <?php endif; ?>
                                        <?php echo clean($menuItem2['title']); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <div class="logout">
        <form id="logout-form-vendor" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo e(csrf_field()); ?>

        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-vendor').submit();"><i class="fa fa-sign-out"></i> <?php echo e(__("Log Out")); ?>

        </a>
    </div>
    <div class="logout">
        <a href="<?php echo e(url('/')); ?>" style="color: #1ABC9C"><i class="fa fa-long-arrow-left"></i> <?php echo e(__("Back to Homepage")); ?></a>
    </div>
</div>
<?php /**PATH /home/ubgmart.com/public_html/etrip/themes/Base/User/Views/frontend/layouts/sidebar.blade.php ENDPATH**/ ?>