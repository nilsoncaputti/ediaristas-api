<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiHandler;

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    // Faz tratamento de exceções no Laravel
    public function render($request, Throwable $e)
    {
        if ($request->is('api/*')) {
            return $this->getJsonException($e);
        }

        return parent::render($request, $e);
    }
}
