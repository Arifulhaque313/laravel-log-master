<?php

namespace App\Http\Controllers;

use App\Services\LoggingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class LoggingController extends Controller
{
    protected LoggingService $loggingService;

    public function __construct(LoggingService $loggingService)
    {
        $this->loggingService = $loggingService;
    }

    /**
     * Demonstrate all log levels
     */
    public function demonstrateLogLevels()
    {
        Log::emergency('System is completely down - EMERGENCY');
        Log::alert('Database connection lost - immediate action required');
        Log::critical('Payment gateway not responding - CRITICAL');
        Log::error('Failed to process user registration');
        Log::warning('User storage quota at 90%');
        Log::notice('Scheduled maintenance completed successfully');
        Log::info('New user registered: john@example.com');
        Log::debug('Query executed successfully in 45ms');

        return response()->json([
            'message' => 'All log levels demonstrated. Check your log files!',
            'log_files' => [
                'main' => storage_path('logs/laravel.log'),
                'errors' => storage_path('logs/errors.log'),
            ]
        ]);
    }

    /**
     * Demonstrate contextual logging
     */
    public function demonstrateContextualLogging()
    {
        // User activity logging
        $this->loggingService->logUserActivity('Profile Updated', [
            'changed_fields' => ['name', 'email'],
            'old_email' => 'old@example.com',
            'new_email' => 'new@example.com'
        ]);

        // API request simulation
        $startTime = microtime(true);
        sleep(1); // Simulate processing time
        $duration = microtime(true) - $startTime;
        
        $this->loggingService->logApiRequest(
            request(),
            response()->json(['status' => 'success']),
            $duration
        );

        return response()->json([
            'message' => 'Contextual logging demonstrated',
            'check_files' => [
                'user_activity' => storage_path('logs/user-activity.log'),
                'api_requests' => storage_path('logs/api-requests.log'),
            ]
        ]);
    }

    /**
     * Demonstrate performance logging
     */
    public function demonstratePerformanceLogging()
    {
        // Database query performance
        $startTime = microtime(true);
        
        // Simulate database operation
        DB::select('SELECT SLEEP(0.5)'); // Simulate slow query
        
        $duration = microtime(true) - $startTime;
        
        $this->loggingService->logPerformance('Database Query', $duration, [
            'query' => 'SELECT * FROM users WHERE active = 1',
            'rows_affected' => 150,
            'slow_query' => $duration > 0.1 ? 'yes' : 'no'
        ]);

        // File processing performance
        $startTime = microtime(true);
        
        // Simulate file processing
        for ($i = 0; $i < 10000; $i++) {
            // Simulate processing
        }
        
        $duration = microtime(true) - $startTime;
        
        $this->loggingService->logPerformance('File Processing', $duration, [
            'files_processed' => 10000,
            'batch_size' => 1000
        ]);

        return response()->json([
            'message' => 'Performance logging demonstrated',
            'check_file' => storage_path('logs/performance.log')
        ]);
    }

    /**
     * Demonstrate exception logging
     */
    public function demonstrateExceptionLogging()
    {
        try {
            // Simulate various types of exceptions
            throw new \InvalidArgumentException('Invalid user data provided');
        } catch (\Exception $e) {
            $this->loggingService->logException($e, [
                'user_input' => ['name' => '', 'email' => 'invalid-email'],
                'validation_errors' => ['name' => 'required', 'email' => 'invalid format']
            ]);
        }

        try {
            // Simulate database exception
            throw new \PDOException('Connection to database failed');
        } catch (\Exception $e) {
            $this->loggingService->logException($e, [
                'database_host' => 'localhost',
                'retry_attempts' => 3
            ]);
        }

        return response()->json([
            'message' => 'Exception logging demonstrated',
            'check_file' => storage_path('logs/errors.log')
        ]);
    }

    /**
     * Demonstrate security logging
     */
    public function demonstrateSecurityLogging()
    {
        // Failed login attempt
        $this->loggingService->logSecurityEvent('Failed Login Attempt', 'warning', [
            'attempted_email' => 'admin@example.com',
            'failed_attempts_count' => 3,
            'locked_out' => false
        ]);

        // Suspicious activity
        $this->loggingService->logSecurityEvent('Suspicious Activity Detected', 'alert', [
            'activity_type' => 'Multiple rapid requests',
            'request_count' => 100,
            'time_window' => '1 minute',
            'blocked' => true
        ]);

        // Password change
        $this->loggingService->logSecurityEvent('Password Changed', 'notice', [
            'user_email' => 'user@example.com',
            'password_strength' => 'strong'
        ]);

        return response()->json([
            'message' => 'Security logging demonstrated',
            'check_file' => storage_path('logs/security.log')
        ]);
    }

    /**
     * Demonstrate channel-specific logging
     */
    public function demonstrateChannelLogging()
    {
        // Log to specific channels
        Log::channel('user_activity')->info('User logged in', ['user_id' => 123]);
        Log::channel('api_requests')->debug('API call made', ['endpoint' => '/api/users']);
        Log::channel('errors')->error('Payment processing failed', ['order_id' => 456]);
        Log::channel('security')->warning('Brute force attempt detected');

        // Log to multiple channels using stack
        Log::stack(['errors', 'slack'])->critical('System critical error detected');

        return response()->json([
            'message' => 'Channel-specific logging demonstrated',
            'channels_used' => ['user_activity', 'api_requests', 'errors', 'security', 'critical_stack']
        ]);
    }

    /**
     * Demonstrate structured logging for analytics
     */
    public function demonstrateStructuredLogging()
    {
        // E-commerce events
        Log::info('Product Purchased', [
            'event_type' => 'purchase',
            'product_id' => 'prod_123',
            'product_name' => 'Laravel Course',
            'price' => 99.99,
            'currency' => 'USD',
            'customer_id' => 'cust_456',
            'payment_method' => 'credit_card',
            'discount_applied' => 10.00,
            'final_amount' => 89.99,
            'timestamp' => now()->toISOString()
        ]);

        // User behavior tracking
        Log::info('Page View', [
            'event_type' => 'page_view',
            'page_url' => '/products/laravel-course',
            'referrer' => 'https://google.com',
            'session_id' => 'sess_789',
            'user_id' => auth()->id() ?? null,
            'device_type' => 'desktop',
            'browser' => 'Chrome',
            'country' => 'US',
            'timestamp' => now()->toISOString()
        ]);

        return response()->json([
            'message' => 'Structured logging for analytics demonstrated',
            'note' => 'Check logs for structured data that can be easily parsed for analytics'
        ]);
    }
}