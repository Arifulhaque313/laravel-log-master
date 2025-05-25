<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Processor\PsrLogMessageProcessor;

return [
    'default' => env('LOG_CHANNEL', 'stack'),
    
    'deprecations' => env('LOG_DEPRECATIONS_CHANNEL', 'null'),
    
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,
        ],

        // Custom channels for our demo
        'user_activity' => [
            'driver' => 'single',
            'path' => storage_path('logs/user-activity.log'),
            'level' => 'info',
        ],

        'api_requests' => [
            'driver' => 'daily',
            'path' => storage_path('logs/api-requests.log'),
            'level' => 'debug',
            'days' => 7,
        ],

        'performance' => [
            'driver' => 'single',
            'path' => storage_path('logs/performance.log'),
            'level' => 'debug',
            'tap' => [App\Logging\PerformanceFormatter::class],
        ],

        'errors' => [
            'driver' => 'daily',
            'path' => storage_path('logs/errors.log'),
            'level' => 'error',
            'days' => 30,
        ],

        'security' => [
            'driver' => 'single',
            'path' => storage_path('logs/security.log'),
            'level' => 'warning',
        ],

        // Example Slack channel (requires webhook URL)
        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Logger',
            'emoji' => ':boom:',
            'level' => env('LOG_LEVEL', 'critical'),
        ],

        'critical_stack' => [
            'driver' => 'stack',
            'channels' => ['errors', 'slack'],
        ],
    ],
];