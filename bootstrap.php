<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

date_default_timezone_set('America/Lima');
require_once "vendor/autoload.php";
$isDevMode = true;
$config = Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/config/yaml"), $isDevMode);
$conn = [
	'host' => getenv('db_host'),
	'driver' => getenv('db_driver'),
	'user' => getenv('db_user'),
	'password' => getenv('db_password'),
	'dbname' => getenv('db_dbname'),
	'port' => getenv('db_port'),
];
$entityManager = EntityManager::create($conn, $config);
