<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require_once '../controller/Login.php';
require_once '../controller/Admin.php';
require_once '../controller/EmpleadoController.php';
require_once '../controller/MwValidaciones.php';


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

//General
$app->post('/login', \Login::class . ':SignIn');

//Rutas Solo Admin
$app->post('/nuevoempleado', \EmpleadoController::class . ':NuevoEmpleado')->add(\MWValidaciones::class . ':ValidarNuevoEmpleado');
$app->post('/actualizarempleado', \EmpleadoController::class . ':ActualizarEmpleado');
$app->post('/eliminarempleado', \EmpleadoController::class . ':EliminarEmpleado');
$app->post('/todoslosempleados', \EmpleadoController::class . ':TodosLosEmpleados');


$app->post('/saludo', \Admin::class . ':Saludo')->add(\Admin::class . ':VerificarAdmin');


$app->run();

?>