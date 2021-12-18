<?php

declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;

define('APP_ROOT', __DIR__);

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {

            return new Settings(
                [
                    'displayErrorDetails' => true, // Should be set to false in production
                    'logError'            => true,
                    'logErrorDetails'     => true,
                    'logger' => [
                        'name' => 'slim-app',
                        'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                        'level' => Logger::DEBUG,
                    ],
                    "determineRouteBeforeAppMiddleware" => true,

                    'db' => [
                        'host' => getenv('db_host'),
                        'driver' => 'pgsql',
                        'username' => getenv('db_user'),
                        'password' => getenv('db_password'),
                        'database' => getenv('db_dbname'),
                        'port' => getenv('db_port'),
                        'charset' => 'utf8'
                    ]
                ],
            );
        }
    ]);
};
