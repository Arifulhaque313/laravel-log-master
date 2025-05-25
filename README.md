🎯 Overview
LaravelLogMaster is a complete demonstration project that covers advanced Laravel logging capabilities. From basic log levels to complex multi-channel configurations, this project provides hands-on examples of production-ready logging strategies.
✨ Features
🔧 Core Logging Features

8 Log Levels: Emergency, Alert, Critical, Error, Warning, Notice, Info, Debug
Multiple Channels: Single file, daily rotation, custom channels
Contextual Logging: Structured data with meaningful context
Custom Formatters: Specialized log output formatting
Stack Channels: Broadcast to multiple destinations simultaneously

📈 Advanced Capabilities

Performance Monitoring: Track execution times and memory usage
Security Logging: Monitor authentication attempts and suspicious activities
API Request Tracking: Complete request/response logging with metrics
Exception Handling: Comprehensive error tracking with stack traces
User Activity Tracking: Monitor user behavior and actions

🛠 Developer Tools

Interactive Web Interface: Test all logging features through a web UI
Artisan Commands: Analyze logs and generate statistics
Automatic Middleware: Log all API requests automatically
Custom Service Classes: Centralized logging with consistent formatting

🚀 Quick Start
Prerequisites

PHP 8.1 or higher
Composer
Laravel 10.x

Installation

Clone the repository
bashgit clone https://github.com/your-username/laravel-log-master.git
cd laravel-log-master

Install dependencies
bashcomposer install

Environment setup
bashcp .env.example .env
php artisan key:generate

Configure logging (optional)
envLOG_CHANNEL=stack
LOG_LEVEL=debug
LOG_SLACK_WEBHOOK_URL=your_slack_webhook_url_here

Create storage directories
bashphp artisan storage:link

Start the development server
bashphp artisan serve

Visit the demo interface
http://localhost:8000/logging-demo


📝 Usage Examples
Basic Logging
phpuse Illuminate\Support\Facades\Log;

// Simple logging
Log::info('User logged in successfully');

// With context
Log::error('Payment failed', [
    'user_id' => 123,
    'order_id' => 456,
    'amount' => 99.99
]);
Channel-Specific Logging
php// Log to specific channels
Log::channel('user_activity')->info('Profile updated');
Log::channel('security')->warning('Failed login attempt');
Log::channel('performance')->debug('Query executed', ['duration' => 45.2]);
Using the Logging Service
phpuse App\Services\LoggingService;

$loggingService = new LoggingService();

// Log user activity
$loggingService->logUserActivity('Profile Updated', [
    'changed_fields' => ['name', 'email']
]);

// Log performance metrics
$loggingService->logPerformance('Database Query', $duration, [
    'query' => 'SELECT * FROM users',
    'rows' => 150
]);
📊 Log Analysis
Using the Built-in Command
bash# Analyze the main log file
php artisan logs:analyze

# Analyze specific log file
php artisan logs:analyze --file=user-activity.log
Sample Output
Log Analysis for laravel.log
=====================================
Total Lines: 1,247

Log Level Distribution:
Emergency :     0 ( 0.00%)
Alert     :     2 ( 0.16%)
Critical  :     5 ( 0.40%)
Error     :    89 ( 7.14%)
Warning   :   156 (12.51%)
Notice    :   203 (16.28%)
Info      :   542 (43.46%)
Debug     :   250 (20.05%)
📁 Log Files Structure
The project creates several specialized log files:
storage/logs/
├── laravel.log          # Main application log
├── user-activity.log    # User actions and behavior
├── api-requests.log     # API calls with performance metrics
├── performance.log      # Performance monitoring (custom format)
├── errors.log          # Error tracking (daily rotation)
└── security.log        # Security events and alerts
🎮 Interactive Demo
The project includes a web interface at /logging-demo where you can:

✅ Test all 8 log levels
✅ Demonstrate contextual logging
✅ Monitor performance metrics
✅ Simulate exception handling
✅ Track security events
✅ Test multiple channels
✅ Generate structured logs

🔧 Configuration
Custom Channels
The project includes pre-configured channels for different use cases:
php'channels' => [
    'user_activity' => [
        'driver' => 'single',
        'path' => storage_path('logs/user-activity.log'),
        'level' => 'info',
    ],
    
    'performance' => [
        'driver' => 'single',
        'path' => storage_path('logs/performance.log'),
        'level' => 'debug',
        'tap' => [App\Logging\PerformanceFormatter::class],
    ],
    
    'security' => [
        'driver' => 'single',
        'path' => storage_path('logs/security.log'),
        'level' => 'warning',
    ],
    
    // ... more channels
],
Slack Integration
For critical alerts, configure Slack notifications:
envLOG_SLACK_WEBHOOK_URL=https://hooks.slack.com/services/YOUR/SLACK/WEBHOOK
🏗 Architecture
Core Components

LoggingService: Centralized logging with contextual data
LoggingDemoController: Interactive demonstration endpoints
LogRequests Middleware: Automatic API request logging
PerformanceFormatter: Custom log formatting for performance metrics
AnalyzeLogs Command: Log analysis and statistics

Design Patterns

Service Layer: Centralized logging logic
Strategy Pattern: Multiple logging channels
Decorator Pattern: Custom formatters
Observer Pattern: Middleware for automatic logging

🚀 Real-World Applications
This project demonstrates logging patterns suitable for:

E-commerce Platforms: Order tracking, payment monitoring
SaaS Applications: User activity, feature usage
API Services: Request/response logging, rate limiting
Financial Systems: Transaction logging, audit trails
Healthcare Apps: HIPAA-compliant activity tracking

📈 Best Practices Demonstrated

✅ Structured Logging: Consistent, parseable log formats
✅ Log Levels: Appropriate level usage for different events
✅ Contextual Data: Rich information for debugging
✅ Performance Monitoring: Track application performance
✅ Security Logging: Monitor security-related events
✅ Log Rotation: Manage disk space with retention policies
✅ Channel Separation: Organize logs by purpose
✅ Error Handling: Comprehensive exception logging

🛡 Security Considerations

Log files are stored outside the web root
Sensitive data is never logged (passwords, API keys)
Security events are tracked and monitored
Log access is restricted through proper file permissions

🤝 Contributing
Contributions are welcome! Please feel free to submit a Pull Request. For major changes, please open an issue first to discuss what you would like to change.
Development Setup

Fork the repository
Create a feature branch: git checkout -b feature-name
Make your changes and add tests
Commit your changes: git commit -am 'Add feature'
Push to the branch: git push origin feature-name
Submit a pull request

📚 Learning Resources

Laravel Logging Documentation
Monolog Documentation
PHP PSR-3 Logging Interface

📄 License
This project is open-sourced software licensed under the MIT license.
🙏 Acknowledgments

Laravel Framework team for the excellent logging implementation
Monolog library for robust logging capabilities
The PHP community for logging standards and best practices

📞 Support
If you encounter any issues or have questions:

Open an issue on GitHub
Check the Laravel documentation
Review the code examples in the demo controller


Built with ❤️ for the Laravel community
Star ⭐ this repository if you found it helpful!