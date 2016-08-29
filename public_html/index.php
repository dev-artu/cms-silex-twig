<?php
use Silex\Application;

require __DIR__ . '/../vendor/autoload.php';

$app = new Application();

$app['debug'] = true;

/*
Home Route
*/

$app->get('/', function(Application $app){
    return $app['twig']->render('login.twig', array(
      'nome' => $nome,
      'password' => $password,
      'action' => 'include/verifica.php'
    ));
})
->bind('login');

/*
Index Route
*/

$app->get('/index', function(Application $app){
  return $app['twig']->render('index.twig');
})
->bind('index');

/*
MySQL
*/
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'dbhost' => 'localhost',
        'dbname' => 'user',
        'user' => 'root',
        'password' => '',
    ),
));

/*
Twig Provider
*/

$app->register(new Silex\Provider\TwigServiceProvider(), [
  'twig.path' => '../views'
]);

$app->run();
