<?php

namespace App\Providers;

use App\Adapter\HuaweiCloudOBSAdapter;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

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
        Storage::extend("huawei_obs", function ($app, $config){
            $adaptor = new HuaweiCloudOBSAdapter($config);
            return new FilesystemAdapter(new Filesystem($adaptor, $config), $adaptor, $config);
        });
    }
}
