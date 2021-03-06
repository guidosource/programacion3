<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

require_once 'api/empleadoApi.php';
require_once 'api/Login.php';


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

$app->post('/agregarEmpleado', \empleadoApi::class . ':AgregarEmpleado');

$app->post('/email/clave', \empleadoApi::class . ':verificarEmpleado');

$app->get("/", \empleadoApi::class . ':todosLosEmpleados')->add(\Login::class . ':VerificarToken');

$app->post('/productos', \empleadoApi::class . ':AgregarProducto');

$app->get('/productos', \empleadoApi::class . ':todosLosProductos');

$app->put('/productos', \empleadoApi::class . ':ModificarProduto');

$app->delete('/productos', \empleadoApi::class . ':BajaProducto');

$app->post('/login', \Login::class . ':SignIn');
/*
$app->post('/usuarioCarga', \usuarioControlador::class . ':usuarioCarga');

$app->post('/verificarUsuario', \usuarioControlador::class . ':verificarUsuario');

$app->post('/altaComentario', \usuarioControlador::class . ':altaComentario');//->add(\Admin::class . ':VerificarAdmin');->add(\Admin::class . ':VerificarAdmin');

$app->post('/altaComentarioImagen', \usuarioControlador::class . ':altaComentario')->add(\usuarioControlador::class . ':mwImagen');


*/

$app->run();
?>