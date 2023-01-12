<?php
namespace Modules\Privilege;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;
use Modules\Hotel\Models\Hotel;
use Modules\Privilege\Models\Privilege;

class ModuleProvider extends ModuleServiceProvider
{

    public function boot(SitemapHelper $sitemapHelper){

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        if(is_installed() and Hotel::isEnable()){

            $sitemapHelper->add("hotel",[app()->make(Hotel::class),'getForSitemap']);
        }
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'privilege'=>[
                "position"=>55,
                'url'        => route('privilege.admin.index'),
                'title'      => __('Privilege'),
                'icon'       => 'fa fa-building-o',
                'permission' => 'privilege_view',
                'children'   => [
                    'all'=>[
                        'url'        => route('privilege.admin.index'),
                        'title'      => __('All privilege'),
                        'permission' => 'privilege_view',
                    ],
                    'create'=>[
                        'url'        => route('privilege.admin.getcreate'),
                        'title'      => __('Add new privilege'),
                        'permission' => 'privilege_create',
                    ],
                    'user'=>[
                        'url'        => route('privilege.admin.user'),
                        'title'      => __('User privilege'),
                        'permission' => 'privilege_view',
                    ],
                    'request'=>[
                        'url'        => route('privilege.admin.upgraderequest'),
                        'title'      => __('Upgrade privilege'),
                        'permission' => 'privilege_view',
                    ],
                ]
            ]
        ];
    }
    public static function getBookableServices()
    {
        return [
            'privilege'=>Privilege::class
        ];
    }

    public static function getTemplateBlocks(){
        if(!Privilege::isEnable()) return [];
        return [
            'member_package'=>'\\Modules\\Privilege\\Blocks\\MemberPackage'
        ];
    }

}
