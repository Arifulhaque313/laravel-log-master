<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class AnalyzeLogs extends Command
{
    protected $signature = 'logs:analyze {--file=laravel.log}';
    protected $description = 'Analyze log files and provide statistics';

    public function handle()
    {
        $filename = $this->option('file');
        $filepath = storage_path("logs/{$filename}");
        
        if (!file_exists($filepath)) {
            $this->error("Log file {$filename} not found!");
            return 1;
        }

        $content = file_get_contents($filepath);
        $lines = explode("\n", $content);
        
        $stats = [
            'total_lines' => count($lines),
            'emergency' => substr_count($content, '.EMERGENCY:'),
            'alert' => substr_count($content, '.ALERT:'),
            'critical' => substr_count($content, '.CRITICAL:'),
            'error' => substr_count($content, '.ERROR:'),
            'warning' => substr_count($content, '.WARNING:'),
            'notice' => substr_count($content, '.NOTICE:'),
            'info' => substr_count($content, '.INFO:'),
            'debug' => substr_count($content, '.DEBUG:'),
        ];

        $this->info("Log Analysis for {$filename}");
        $this->line("=====================================");
        $this->line("Total Lines: {$stats['total_lines']}");
        $this->line("");
        $this->line("Log Level Distribution:");
        foreach (['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'] as $level) {
            $count = $stats[$level];
            $percentage = $stats['total_lines'] > 0 ? round(($count / $stats['total_lines']) * 100, 2) : 0;
            $this->line(sprintf("%-10s: %5d (%5.2f%%)", ucfirst($level), $count, $percentage));
        }

        return 0;
    }
}