<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require_once '../controller/Login.php';
require_once '../controller/Admin.php';


$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
    ],
];
$c = new \Slim\Container($configuration);
$app = new \Slim\App($c);

//$app = new \Slim\App;

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->post('/login', \Login::class . ':SignIn');

$app->post('/altaEmpleado', \Admin::class . ':AltaEmpleado');//->add(\Admin::class . ':VerificarAdmin');

$app->post('/saludo', \Admin::class . ':Saludo')->add(\Admin::class . ':VerificarAdmin');


$app->run();

?>