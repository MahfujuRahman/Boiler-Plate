<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Modules\Management\WarehouseManagement\WarehouseProductOut\Models\WareHouseProductOutProductModel as WarehouseProductOut;
use App\Modules\Management\WarehouseManagement\WarehouseProductOut\Observer\WarehouseProductOutObserver;

use App\Models\Setting\SettingTitleValue;
use Laravel\Passport\Console\ClientCommand;
use Laravel\Passport\Console\InstallCommand;
use Laravel\Passport\Console\KeysCommand;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        // WarehouseProductOut::observe(WarehouseProductOutObserver::class);
        Schema::defaultStringLength(191);
        // Passport::routes();
        $this->commands([
            InstallCommand::class,
            ClientCommand::class,
            KeysCommand::class,
        ]);

        // View::composer('*', function ($view) {
        //     $app_settings = SettingTitleValue::get();
        //     $GLOBALS['app_settings'] = $app_settings;
        //     $view->with([
        //         'app_settings' => $app_settings,
        //     ]);
        // });
    }
}
