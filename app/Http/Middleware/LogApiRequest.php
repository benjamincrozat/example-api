<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Throwable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Emits one structured log event per API request.
 */
class LogApiRequest
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next) : Response
    {
        $startedAt = hrtime(true);
        $requestId = $request->headers->get('X-Request-Id', (string) Str::uuid());

        try {
            $response = $next($request);
        } catch (Throwable $throwable) {
            Log::error('api.request.failed', [
                'request_id' => $requestId,
                'method' => $request->method(),
                'path' => '/' . $request->path(),
                'route' => $request->route()?->getName(),
                'duration_ms' => round((hrtime(true) - $startedAt) / 1_000_000, 2),
                'exception' => $throwable::class,
            ]);

            throw $throwable;
        }

        if (! $response->headers->has('X-Request-Id')) {
            $response->headers->set('X-Request-Id', $requestId);
        }

        Log::info('api.request.completed', [
            'request_id' => $requestId,
            'method' => $request->method(),
            'path' => '/' . $request->path(),
            'route' => $request->route()?->getName(),
            'status' => $response->getStatusCode(),
            'duration_ms' => round((hrtime(true) - $startedAt) / 1_000_000, 2),
        ]);

        return $response;
    }
}
