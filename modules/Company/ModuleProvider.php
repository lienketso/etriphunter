<?php


namespace Modules\Company;

use Modules\Company\Models\Company;
use Modules\Core\Helpers\SitemapHelper;
use Modules\ModuleServiceProvider;


class ModuleProvider extends ModuleServiceProvider
{
    public function boot(SitemapHelper $sitemapHelper){

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

    }
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public static function getAdminMenu()
    {
        return [
            'company'=>[
                "position"=>56,
                'url'        => route('company.admin.index'),
                'title'      => 'Đơn vị',
                'icon'       => 'fa fa-building-o',
                'children'   => [
                    'all'=>[
                        'url'        => route('company.admin.index'),
                        'title'      => 'Tất cả đơn vị',
                    ],
                    'create'=>[
                        'url'        => route('company.admin.create'),
                        'title'      => 'Thêm đơn vị',
                    ],
                ]
            ]
        ];
    }

    public static function getBookableServices()
    {
        return [
            'privilege'=>Company::class
        ];
    }

}
