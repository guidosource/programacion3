<?php
require_once '../model/Empleado.php';
require_once '../controller/AutentificadorJWT.php';

class Admin{
    public function AltaEmpleado($request,$response){

        $datos = $request->getParsedBody();
        if(isset($datos['nombre']) && isset($datos['email']) && isset($datos['clave']) && isset($datos['sexo']) && isset($datos['turno']) && isset($datos['admin'])){
            // Se carga el nuevo empleado con sus datos
            $empleado = new Empleado();
            $empleado->nombre = $datos['nombre'];
            $empleado->email = $datos['email'];
            $empleado->clave = $datos['clave'];
            $empleado->sexo = $datos['sexo'];
            $empleado->admin = $datos['admin'];
            $empleado->turno = $datos['turno'];
            // Se inserta en la bd el nuevo empleado.
            $empleado->Alta();
        }
        else{
            $respuesta = new stdclass();
            $respuesta->error = "undefined-index";
            return $response->withJson($respuesta,500);
        }
    }

    public function VerificarAdmin($request,$response,$next){

        $token = $request->getParsedBody();
        AutentificadorJWT::VerificarToken($token);
        //$objDelaRespuesta= new stdclass();
        //$objDelaRespuesta->respuesta="";
        //$nueva=$response->withJson($objDelaRespuesta, 401);
        
        $response = $next($request,$response);
        return $response;

    }
    
    public function Saludo($request,$response){
        echo "hello";
        return $response;
    }
    
}
