<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ConsultaCEP\Providers\ViaCEP;
use App\Services\ConsultaCEP\ConsultaCEPInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ConsultaCEPInterface::class, function ($app) {
            return new ViaCEP;
        });
    }

    public function boot()
    {
        //
    }
}
