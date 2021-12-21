<?php

require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


$isDevMode = true;
$proxyDir = null;
$cache = null;
$useSimpleAnnotationReader = false;
$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);
// $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src/Domain"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);


// database configuration parameters
$conn = array(
    'host' => getenv('db_host'),
    'driver' => 'pdo_pgsql',
    'user' => getenv('db_user'),
    'password' => getenv('db_password'),
    'dbname' => getenv('db_dbname'),
    'port' => getenv('db_port')
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);