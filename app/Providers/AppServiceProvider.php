<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ConsultaCEP\Providers\ViaCEP;
use App\Services\ConsultaCidade\Provedores\Ibge;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\ConsultaCEP\ConsultaCEPInterface;
use TeamPickr\DistanceMatrix\Licenses\StandardLicense;
use App\Services\ConsultaCidade\ConsultaCidadeInterface;
use App\Services\ConsultaDistancia\ConsultaDistanciaInterface;
use App\Services\ConsultaDistancia\Provedores\GoogleMatrix;

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

        $this->app->bind(ConsultaDistanciaInterface::class, function ($app) {
            $license = new StandardLicense(config('google.key'));

            return new GoogleMatrix($license);
        });
    }

    public function boot()
    {
        JsonResource::withoutWrapping();
    }
}
