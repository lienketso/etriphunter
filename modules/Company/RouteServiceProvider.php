<?php


namespace Modules\Company;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $moduleNamespace = 'Modules\Company\Controllers';
    protected $adminModuleNamespace = 'Modules\Company\Admin';

    public function boot()
    {
        parent::boot();
    }

    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapLanguageRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(__DIR__ . '/Routes/web.php');
    }

    protected function mapLanguageRoutes()
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->prefix(app()->getLocale())
            ->group(__DIR__ . '/Routes/language.php');
    }
    protected function mapAdminRoutes()
    {
        Route::middleware(['web','dashboard'])
            ->namespace($this->adminModuleNamespace)
            ->prefix(config('admin.admin_route_prefix').'/module/company')
            ->group(__DIR__ . '/Routes/admin.php');
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(__DIR__ . '/Routes/api.php');
    }

}
