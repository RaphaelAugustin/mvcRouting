<?php

require '../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Taf\Router\Router;
use Symfony\Component\Yaml\Yaml;

$request = Request::createFromGlobals();

//we get the routes config
$config = Yaml::parse(file_get_contents('../config/routing.yml'));


// we instance the Router with the config.
$router = new Router($config);

// ask the Router for the action
$controllerAction = $router->getControllerAction($request);


// init twig
$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    'cache' => '../cache/templates',
));


//instance the right Controller with request as params
$controllerClass = $controllerAction['controller'];
$action = $controllerAction['action'];
$controller = new $controllerClass($twig);
$response = $controller->$action($request);


//and we send the response
if ($response instanceof Response) {
    $response->send();
}

