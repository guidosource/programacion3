<?php
require_once '../model/Empleado.php';
require_once '../controller/AutentificadorJWT.php';

//CLASE CON LAS ACCIONES DEL USUARIO ADMINISTRADOR
class AdminController{
    
    public function AltaEmpleado($request,$response){

        $datos = $request->getParsedBody();
        // Se carga el nuevo empleado con sus datos
        $empleado = new Empleado();
        $empleado->nombre = $datos['nombre'];
        $empleado->email = $datos['email'];
        $empleado->clave = $datos['clave'];
        $empleado->sexo = $datos['sexo'];
        $empleado->adm = $datos['admin'];
        $empleado->turno = $datos['turno'];
        // Se inserta en la bd el nuevo empleado.
        try{
            $empleado->Alta();
            $response->write('Nuevo empleado dado de alta');
            $response->withStatus(200);
            return $response;
        }
        catch(Exception $ex){
            $respuesta = new stdclass();
            $respuesta->error = $ex->getMessage();
            return $response->withJson($respuesta,500);    
        }
    }

    public function SuspenderEmpleado($request,$response){
        if(isset($request->getParsedBody()['id'])){
            $datos = $request->getParsedBody();
            $empleado = Empleado::BuscarPorId($datos['id']);
            if(count($empleado) > 0){
                var_dump($empleado);
                die();
            }
        }
        else{
            
        }
    }

    public function BorrarEmpleado($request,$response){

    }
    
    public function Saludo($request,$response){
        echo "soy admin";
        return $response;
    }
}
