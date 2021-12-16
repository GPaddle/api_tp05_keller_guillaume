<?php

declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;
use Slim\Logger as SlimLogger;

define('APP_ROOT', __DIR__);

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {

            if ($ini = @parse_ini_file(APP_ROOT . '/../.env') === false) {
                $error = error_get_last();
                echo "HTTP request failed. Error was: " . $error['message'];
            }

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

                    'doctrine' => [
                        // if true, metadata caching is forcefully disabled
                        'dev_mode' => true,

                        // path where the compiled metadata info will be cached
                        // make sure the path exists and it is writable
                        'cache_dir' => APP_ROOT . '/var/doctrine',

                        // you should add any other path containing annotated entity classes
                        'metadata_dirs' => [APP_ROOT . '/src/Domain'],

                        'connection' => [
                            'host' => $ini['db_host'] ?? getenv('db_host'),
                            'driver' => $ini['db_driver'] ?? getenv('db_driver'),
                            'user' => $ini['db_user'] ?? getenv('db_user'),
                            'password' => $ini['db_password'] ?? getenv('db_password'),
                            'dbname' => $ini['db_dbname'] ?? getenv('db_dbname'),
                            'port' => $ini['db_port'] ?? getenv('db_port'),
                            'charset' => 'utf8'
                        ]
                    ]
                ],
            );
        }
    ]);
};
