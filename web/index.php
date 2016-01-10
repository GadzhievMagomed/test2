<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once __DIR__.'/../vendor/autoload.php';


$app = new Silex\Application();
$app['debug'] = true;


// Doctrine
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'host'     => 'localhost',
        'dbname'   => 'test1',
        'user'     => 'root',
        'password' => '',
    ),
));

$models = [
    __DIR__."/../src/Models/"

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

// END Doctrine


// Twig
$loader = new Twig_Loader_Filesystem(__DIR__.'/../src/Views');


$app->twig = new Twig_Environment($loader, array(
    //'cache' => __DIR__.'/../storage/twig',
));

// END Twig



require_once __DIR__.'/../src/controllers.php';


$app->run();


