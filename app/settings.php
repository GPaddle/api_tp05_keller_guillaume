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

                    'doctrine' => [
                        // if true, metadata caching is forcefully disabled
                        'dev_mode' => true,

                        // path where the compiled metadata info will be cached
                        // make sure the path exists and it is writable
                        'cache_dir' => APP_ROOT . '/var/doctrine',

                        // you should add any other path containing annotated entity classes
                        'metadata_dirs' => [APP_ROOT . '/../src/Domain'],

                        'connection' => [
                            'host' => getenv('db_host'),
                            'driver' => getenv('db_driver'),
                            'user' => getenv('db_user'),
                            'password' => getenv('db_password'),
                            'dbname' => getenv('db_dbname'),
                            'port' => getenv('db_port'),
                            'charset' => 'utf8'
                        ]
                    ]
                ],
            );
        }
    ]);
};
