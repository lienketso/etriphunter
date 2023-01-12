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
        @if($avatar_url = $dataUser->getAvatarUrl())
            <div class="avatar avatar-cover" style="background-image: url('{{$dataUser->getAvatarUrl()}}')"></div>
        @else
            <span class="avatar-text">{{ucfirst($dataUser->getDisplayName()[0])}}</span>
        @endif
    </div>
    <div class="user-profile-avatar">
        <div class="info-new">
            <span class="role-name badge badge-info">{{$dataUser->role_name}}</span>
            <h5>{{$dataUser->getDisplayName()}}</h5>
            @if($dataUser->privilege_id)
            @php
            $pre = new Privilege();
            $preInfo = $pre->where('id',$dataUser->privilege_id)->first();
            @endphp
            @if(  new DateTime($dataUser->privilege_available) >= new DateTime('now') && $preInfo->status == 'publish')
            <h5>{{$preInfo->privilege_name}}</h5>
            @endif
            @endif
            <p>{{ __("Member Since :time",["time"=> date("M Y",strtotime($dataUser->created_at))]) }}</p>

        </div>
{{--        <div class="btn-setting-user">--}}
{{--            <a class="btn-become-daily" href=" {{ route("user.become_agency") }}"><i class="fa fa-handshake-o"></i> Trở thành đại lý</a>--}}
{{--        </div>--}}
    </div>
    <div class="user-profile-plan">
        @if( !Auth::user()->hasPermissionTo("dashboard_vendor_access") and setting_item('vendor_enable'))
            <a href=" {{ route("user.upgrade_vendor") }}">{{ __("Become a vendor") }}</a>
        @endif
    </div>
    <div class="sidebar-menu">
        @if(Auth::user()->vendor_parent==0)
        <ul class="main-menu">
            @foreach($menus as $menuItem)
                <li class="{{$menuItem['class']}}">
                    <a href="{{ url($menuItem['url']) }}">
                        @if(!empty($menuItem['icon']))
                            <span class="icon text-center"><i class="{{$menuItem['icon']}}"></i></span>
                        @endif
                        {!! clean($menuItem['title']) !!}

                    </a>
                    @if(!empty($menuItem['children']))
                        <i class="caret"></i>
                    @endif
                    @if(!empty($menuItem['children']))
                        <ul class="children">
                            @foreach($menuItem['children'] as $menuItem2)
                                <li class="{{$menuItem2['class']}}"><a href="{{ url($menuItem2['url']) }}">
                                        @if(!empty($menuItem2['icon']))
                                            <i class="{{$menuItem2['icon']}}"></i>
                                        @endif
                                        {!! clean($menuItem2['title']) !!}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
        @else

        <ul class="main-menu">
            @if($dataUser && !empty($dataUser->business_areas))
                @php
                    $business = json_decode($dataUser->business_areas);
                @endphp
            @foreach($business as $d)
                    <li><a href="{{route($d.'.vendor.index')}}"><i class="fa fa-heart-o"></i> Quản lý {{($d=='event') ? 'Tiện ích' : $d }}</a></li>
                @endforeach
                @else
            @endif
        </ul>
            @endif
    </div>
    <div class="logout">
        <a href="{{route('vendor.list-user')}}"><i class="fa fa-user-circle"></i> Quản lý tài khoản</a>
    </div>
    <div class="logout">
        <a href="{{route('user.profile.index')}}"><i class="fa fa-user"></i> Cập nhật profile</a>
    </div>
    <div class="logout">
        <form id="logout-form-vendor" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-vendor').submit();"><i class="fa fa-sign-out"></i> {{__("Log Out")}}
        </a>
    </div>
    <div class="logout">
        <a href="{{url('/')}}" style="color: #1ABC9C"><i class="fa fa-long-arrow-left"></i> {{__("Back to Homepage")}}</a>
    </div>
</div>
