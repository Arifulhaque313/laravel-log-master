<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LoggingService
{
    /**
     * Log user activity with context
     */
    public function logUserActivity(string $action, array $context = []): void
    {
        Log::channel('user_activity')->info($action, array_merge([
            'user_id' => auth()->id() ?? 'guest',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'timestamp' => now()->toISOString(),
        ], $context));
    }

    /**
     * Log API request with performance metrics
     */
    public function logApiRequest(Request $request, $response, float $duration): void
    {
        Log::channel('api_requests')->info('API Request', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status_code' => $response->getStatusCode(),
            'duration_ms' => round($duration * 1000, 2),
            'memory_usage' => round(memory_get_peak_usage(true) / 1024 / 1024, 2),
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * Log performance metrics
     */
    public function logPerformance(string $operation, float $duration, array $context = []): void
    {
        Log::channel('performance')->debug($operation, array_merge([
            'duration' => round($duration * 1000, 2), // Convert to milliseconds
            'memory_usage' => round(memory_get_peak_usage(true) / 1024 / 1024, 2), // Convert to MB
            'timestamp' => now()->toISOString(),
        ], $context));
    }

    /**
     * Log security events
     */
    public function logSecurityEvent(string $event, string $level = 'warning', array $context = []): void
    {
        Log::channel('security')->{$level}($event, array_merge([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'user_id' => auth()->id() ?? 'anonymous',
            'timestamp' => now()->toISOString(),
        ], $context));
    }

    /**
     * Log exceptions with full context
     */
    public function logException(\Throwable $exception, array $context = []): void
    {
        Log::channel('errors')->error('Exception occurred', array_merge([
            'exception_class' => get_class($exception),
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString(),
            'user_id' => auth()->id() ?? 'guest',
            'url' => request()->fullUrl(),
            'timestamp' => now()->toISOString(),
        ], $context));
    }
}