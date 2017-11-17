<?php
class MwValidaciones{

    public function ValidarNuevoEmpleado($response,$request,$next){

        $errores = array();
        $reg_nombre_apellido = "/^[a-zA-ZÑñáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
        
        //Comprueba si llegaron los campos requeridos
        if(isset($response->getParsedBody()['nombre']) && isset($response->getParsedBody()['email']) && 
        isset($response->getParsedBody()['sexo']) && isset($response->getParsedBody()['clave']) &&
        isset($response->getParsedBody()['turno']) && isset($response->getParsedBody()['adm'])){
            //nombre
            if(!empty($response->getParsedBody()['nombre'])){
                if(preg_match($reg_nombre_apellido,$response->getParsedBody()['nombre'])){
                    $errores[] = "Nombre OK";
                }
                else{
                    $errores[] = "Ingreso invalido. Solo letras";
                }
            }
            else{
                $errores[] = "El nombre esta vacio";
            }
            //apellido
            if(!empty($response->getParsedBody()['apellido'])){
                if(preg_match($reg_nombre_apellido,$response->getParsedBody()['apellido'])){
                    $errores[] = "Apellido OK";
                }
                else{
                    $errores[] = "Ingreso invalido. Solo letras";
                }
            }
            else{
                $errores[] = "El apellido esta vacio";
            }
            //email
            if(!empty($response->getParsedBody()['email'])){
                if(preg_match($reg_nombre_apellido,$response->getParsedBody()['email'])){
                    $errores[] = "Email OK";
                }
                else{
                    $errores[] = "Ingreso invalido. Formato invalido";
                }
            }
            else{
                $errores[] = "El email esta vacio";
            }
            //sexo
            //clave
            //turno
            //adm
            if(count($errores) == 0){
                //TODO OK!
                $response = $next($response,$request);
                return $response;
            }
            else{
                //HAY ERRORES.
                return $response->withJson($errores,500);
            }
        }
        else{
            $response->write('No se han especificado los campos requeridos');
            $response->withStatus(500);
            return $response;
        }

    }


}




?>