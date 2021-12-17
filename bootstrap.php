<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src/Domain/Product"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

// database configuration parameters
$conn = array(
    'host' => $_ENV['db_host'],
    'driver' => 'pdo_pgsql',
    'user' => $_ENV['db_user'],
    'password' => $_ENV['db_password'],
    'dbname' => $_ENV['db_dbname'],
    'port' => $_ENV['db_port']
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);
