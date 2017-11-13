<?php

require_once '../model/Empleado.php';
require_once '../controller/AutentificadorJWT.php';


class Login{

    public function SignIn($request,$response){
        
        $datos = $request->getParsedBody();

        //Verifica que los campos no esten indefinidos.
        if(isset($datos['email']) && isset($datos['clave'])){

            $empleadoEncontrado = Empleado::BuscarPorEmailClave($datos['email'],$datos['clave']);
            //Verifica si el usuario y la clave son correctas
            if(count($empleadoEncontrado)>0){
                
                $data = array("nombre" => $empleadoEncontrado[0]->nombre,
                "email" => $empleadoEncontrado[0]->email,
                "id" => $empleadoEncontrado[0]->id,
                "admin" => $empleadoEncontrado[0]->adm);

                $token = AutentificadorJWT::CrearToken($data);
                return $response->withJson($token,200);
                
            }
            else{
                $respuesta = new stdclass();
                $respuesta->error = "Email o contraseña incorrectos";
                return $response->withJson($respuesta,500);
            }
        }
        else{
            $respuesta = new stdclass();
            $respuesta->error = "undefined-index";
            return $response->withJson($respuesta,500);
        }
    }
}


?>