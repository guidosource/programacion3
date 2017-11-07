<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once '../vendor/autoload.php';
require_once '../route/EstacionamientoApi.php';
require_once '../route/Login.php';

$app = new \Slim\App;
/*$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});*/


$app->post('/login', \Login::class. 'VerificarUsuario');

/*
$app->group('/estacionamiento', function () {
    
     $this->get('/', \EstacionamientoApi::class . ':TraerTodos');
    
    // $this->get('/{id}', \cdApi::class . ':traerUno');
   
    // $this->post('/', \cdApi::class . ':CargarUno');
   
    // $this->delete('/', \cdApi::class . ':BorrarUno');
   
   //  $this->put('/', \cdApi::class . ':ModificarUno');
        
   });
*/
$app->run();

?>

