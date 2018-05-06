<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require_once '../controller/Login.php';
require_once '../controller/AdminController.php';
require_once '../controller/EmpleadoController.php';

require_once '../controller/ValidacionPermisos.php';

//MIDDLEWARE

require_once '../mw/Cors.php';
require_once '../mw/MwValidaciones.php';

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
$app->post('/nuevoempleado', \EmpleadoController::class . ':NuevoEmpleado')->add(\MWValidaciones::class . ':ValidarNuevoEmpleado')->add(\ValidacionPermisos::class . ':VerificarAdmin');
$app->post('/actualizarempleado', \EmpleadoController::class . ':ActualizarEmpleado');
$app->post('/eliminarempleado', \EmpleadoController::class . ':EliminarEmpleado');
$app->get('/todoslosempleados', \EmpleadoController::class . ':TodosLosEmpleados');
$app->post('/suspenderempleado', \AdminController::class . ':SuspenderEmpleado');

//Rutas Empleados/Todos

$app->get('/empleado/estacionados', \EmpleadoController::class . ':traerVehiculosEstacionados')->add(\Cors::class . ':HabilitarCORSTodos');
$app->post('/empleado/altavehiculo', \EmpleadoController::class . ':altaVehiculo')->add(\Cors::class . ':HabilitarCORSTodos');

//Pruebas
$app->post('/saludoAdm', \AdminController::class . ':Saludo')->add(\ValidacionPermisos::class . ':VerificarAdmin');
$app->post('/saludoE', \EmpleadoController::class . ':SaludoEmpleado')->add(\ValidacionPermisos::class . ':VerificarToken');

$app->run();

?>