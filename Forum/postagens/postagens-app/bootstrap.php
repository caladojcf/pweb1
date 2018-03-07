<?php
/**
 * Created by PhpStorm.
 * User: Berg
 * Date: 28/03/17
 * Time: 12:13
 *
 * Instanciar um entitiy manager
 */
// bootstrap.php
require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("/src/model");
$isDevMode = false;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'forum',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$config->setAutoGenerateProxyClasses(\Doctrine\Common\Proxy\AbstractProxyFactory::AUTOGENERATE_ALWAYS);
$entityManager = EntityManager::create($dbParams, $config);