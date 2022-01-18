<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions(
        [
            LoggerInterface::class => function (ContainerInterface $container) {
                $settings = $container->get(SettingsInterface::class);

                $loggerSettings = $settings->get('logger');
                $logger = new Logger($loggerSettings['name']);

                $processor = new UidProcessor();
                $logger->pushProcessor($processor);

                $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
                $logger->pushHandler($handler);

                return $logger;
            },
            EntityManagerInterface::class => function (ContainerInterface $container): EntityManager {
                
                $settings = $container->get(SettingsInterface::class);
                $doctrine = $settings->get('doctrine');

                $config = Setup::createYAMLMetadataConfiguration(
                    $doctrine['metadata_dirs'],
                    $doctrine['dev_mode']
                );

                $config->setMetadataDriverImpl(
                    new AnnotationDriver(
                        new AnnotationReader,
                        $doctrine['metadata_dirs']
                    )
                );

                $entityManager =  EntityManager::create(
                    $doctrine['connection'],
                    $config
                );

                return $entityManager;
            }
        ]

    );
};
