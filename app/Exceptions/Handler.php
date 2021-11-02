<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        if ($request->is('api/*') || $request->is('auth/*')) {
            return $this->getJsonException($e);
        }

        return parent::render($request, $e);
    }
}
