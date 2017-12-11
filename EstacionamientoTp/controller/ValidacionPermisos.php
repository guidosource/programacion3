<?php
require_once '../controller/AutentificadorJWT.php';
require_once '../model/Empleado.php';

class ValidacionPermisos{


        public function VerificarAdmin($request,$response,$next){
                
                $token = $request->getHeader('token');
                
                //$eltoken = $token[0];
                try{
                        AutentificadorJWT::VerificarToken($token[0]);
                        $data = AutentificadorJWT::ObtenerData($token[0]);
                        if($data->admin == Admin::TRUE){
                        $response = $next($request,$response);
                        return $response;
                        }
                        else{
                        $response->withStatus(500);
                        $response->withHeader('Content-Type', 'text/html');
                        $response->write('Permiso denegado');
                        return $response;
                        }
                }
                catch(Exception $ex){
                        $respuesta = new stdclass();
                        $respuesta->error = "token invalido";
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
}

?>