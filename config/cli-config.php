<?php
use Doctrine\ORM\Tools\Setup;

$models = [
    __DIR__."/../src/Models"

];

$config = Setup::createAnnotationMetadataConfiguration($models, true);
$conn = array(
    'driver' => 'pdo_mysql',
    'host'     => 'localhost',
    'dbname'   => 'test1',
    'user'     => 'root',
    'password' => '',
);

$app->em = EntityManager::create($conn, $config);

$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($app->em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($app->em)
));
return $helperSet;