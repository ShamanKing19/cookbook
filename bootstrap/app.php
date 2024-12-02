<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api/v1.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // TODO: Вернуть, когда будет фронт
//        $exceptions->render(function (\Throwable $e, Request $request) {
//            if ($request->is('api/*')) {
//                return response()->json([
//                    'message' => $e->getMessage(),
//                    'trace' => $e->getTrace()
//                ], 404);
//            }
//        });
    })->create();
