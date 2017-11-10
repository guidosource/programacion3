<?php
require_once '../vendor/autoload.php';
require_once '../model/Empleado.php';
use Firebase\JWT\JWT;

class Login{

    //private static $clave = 'top_secret';
    //private static $encriptacion = ['HS256'];

    public function VerificarUsuario($request,$response){
        
        $datos = $request->getParsedBody();

        //Verifica que los campos no esten indefinidos.
        if(isset($datos['email']) && isset($datos['clave'])){

            $resultado = Empleado::BuscarPorEmailClave($datos['email'],$datos['clave']);
        }
        else{
            $respuesta = new stdclass();
            $respuesta->error = "undefined-index";
            return $response->withJson($respuesta,500);
        }
        //Verifica si el usuario y la clave son correctas
        if($resultado == 1){
            
        }
        else{
            $respuesta = new stdclass();
            $respuesta->error = "Email o contraseña incorrectos";
            return $response->withJson($respuesta,500);
        }
       
        /*
        try{
            //throw new Exception("");
            $datos = $request->getParsedBody();
            $resultado = Empleado::BuscarPorNombreClave($datos['nombre'],$datos['clave']);
            if(!empty($resultado)){

                $token = Login::GenerarToken($resultado);
                var_dump($token);
                die();
            }
        }
        catch(Exception $e){
            echo "hola";
            //return $reponse->withJson("Error", 404);
        }
        */

    }

    
    public static function GenerarToken($datos)
    {
        $ahora = time();
        /*
         parametros del payload
         https://tools.ietf.org/html/rfc7519#section-4.1
         + los que quieras ej="'app'=> "API REST CD 2017" 
        */
        $payload = array(
        	'iat'=>$ahora,
            'exp' => $ahora + (20),
            'aud' => self::Aud(),
            'data' => $datos,
            'app'=> "API REST CD 2017"
        );
     
        return JWT::encode($payload, self::$claveSecreta);
    }
}


?>