<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ConsultaCEP\Providers\ViaCEP;
use App\Services\ConsultaCidade\Provedores\Ibge;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\ConsultaCEP\ConsultaCEPInterface;
use App\Services\ConsultaCidade\ConsultaCidadeInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ConsultaCEPInterface::class, function ($app) {
            return new ViaCEP;
        });

        $this->app->singleton(ConsultaCidadeInterface::class, function ($app) {
            return new Ibge;
        });
    }

    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}
