<?php

require_once './model/empleados.php';
require_once 'AutentificadorJWT.php';


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
                "admin" => $empleadoEncontrado[0]->perfil);

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
    public function VerificarToken($request,$response,$next){

        $token = $request->getHeader('token');
        try{
            AutentificadorJWT::VerificarToken($token[0]);
            $response = $next($request,$response);
            return $response;
        }
        catch(Exception $ex){
            $respuesta = new stdclass();
            $respuesta->error = "token invalido";
            return $response->withJson($respuesta,500);
        
        }

    }
    public function VerificarAdmin($request,$response,$next){
        
        $token = $request->getHeader('token');
        
        //$eltoken = $token[0];
            //AutentificadorJWT::VerificarToken($token[0]);
            $data = AutentificadorJWT::ObtenerData($token[0]);
            if($data->perfil == 'admin'){
                $response = $next($request,$response);
                return $response;
            }
            else{
                $response->withStatus(404);
                $response->withHeader('Content-Type', 'text/html');
                $response->write('Permiso Denegado');
                return $response;
            }
    }
}


?>