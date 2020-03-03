<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'displayErrorDetails' => getenv('DISPLAY_ERROR_DETAILS'), // Should be set to false in production
            'logErrors' => getenv('LOG_ERRORS'), // Should be set to false in production
            'logErrorDetails' => getenv('LOG_ERROR_DETAILS'), // Should be set to false in production
            'logger' => [
                'name' => 'slim-app',
                'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                'level' => Logger::DEBUG,
            ],
            // Database connection settings
            "db" => [
                'driver' => 'mysql',
                'host' => getenv('DB_HOST'),
                'database' => getenv('DB_DATABASE'),
                'username' => getenv('DB_USERNAME'),
                'password' => getenv('DB_PASSWORD'),
                'collation' => 'utf8_general_ci',
                'charset' => 'utf8',
                'prefix' => 'nh_'
            ],
        ],
    ]);
};
