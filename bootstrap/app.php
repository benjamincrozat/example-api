<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Middleware\LogApiRequest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
    )
    ->withMiddleware(function (Middleware $middleware) : void {
        $middleware->api(append: [
            LogApiRequest::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) : void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request, Throwable $throwable) : bool => $request->is('api/*') || $request->expectsJson(),
        );

        $exceptions->render(function (ModelNotFoundException $exception, Request $request) : ?JsonResponse {
            if (! $request->is('api/*')) {
                return null;
            }

            return response()->json([
                'message' => 'Resource not found.',
            ], 404);
        });

        $exceptions->render(function (NotFoundHttpException $exception, Request $request) : ?JsonResponse {
            if (! $request->is('api/*')) {
                return null;
            }

            return response()->json([
                'message' => 'Resource not found.',
            ], 404);
        });

        $exceptions->context(function () : array {
            $request = request();

            if (! $request instanceof Request || ! $request->is('api/*')) {
                return [];
            }

            return [
                'request_id' => $request->headers->get('X-Request-Id'),
                'method' => $request->method(),
                'path' => '/' . $request->path(),
                'route' => $request->route()?->getName(),
            ];
        });
    })
    ->create();
