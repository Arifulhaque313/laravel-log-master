<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;

class PerformanceFormatter
{
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
                "[%datetime%] PERFORMANCE: %message% | Duration: %context.duration%ms | Memory: %context.memory_usage%MB\n"
            ));
        }
    }
}