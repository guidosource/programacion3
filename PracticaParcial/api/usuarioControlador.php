
<?php

require_once './clases/usuario.php';
require_once './clases/comentario.php';

class usuarioControlador{

    public function usuarioCarga($request,$response){

        $datos = $request->getParsedBody();
        $usuario = new Usuario();
        $usuario->nombre = $datos['nombre'];
        $usuario->edad = $datos['edad'];
        $usuario->email = $datos['email'];
        $usuario->clave = $datos['clave'];
        $usuario->perfil = $datos['perfil'];
        $usuario->Alta();
        return $response->withJson("Usuario dado de alta",200);
    }


    public function altaComentario($request,$response){
        
        $pathImagen = NULL;
        $datos = $request->getParsedBody(); //campos del body
        $files = $request->getUploadedFiles(); //archivos del $_FILES

        //Analiza si se recibieron archivos
        if(count($files)>0){
            
            $extension = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION); //obtiene extension 
            $ultimoid = comentario::ObtenerUltimoId(); 
            $pathImagen = $ultimoid[0]['id'] + 1 . $datos['titulo'] . '.' . $extension; 
            //var_dump($pathImagen);
            //die();
            
        }
        
        $usuarioEncontrado = usuario::BuscarPorEmail($datos['email']);
        if(count($usuarioEncontrado) >0){
            
            $comentario = new comentario();
            $comentario->titulo = $datos['titulo'];
            $comentario->email = $datos['email'];
            $comentario->comentario = $datos['comentario'];
            $comentario->pathImagen = $pathImagen;
            $comentario->Alta();
            $response->getBody()->write('Comentario exisitoso');
            return $response;
        }
        else{
            $response->getBody()->write('No existe el email');
            $newResponse = $response->withStatus(401);
            return $newResponse;
        }
    }

    public function verificarUsuario($request,$response){

        $datos = $request->getParsedBody();
        $pass = sha1($datos['clave']);
        $usuarioEncontrado = usuario::BuscarPorEmail($datos['email']);
        if(count($usuarioEncontrado) > 0){
            if($usuarioEncontrado[0]->clave == $pass){

                $response->getBody()->write('Bienvenido');
                return $response;
            }
            else{
                $response->getBody()->write('Eror de clave');
                $newResponse = $response->withStatus(401);
                return $newResponse;
            }
        }       
        else{

            $response->getBody()->write('No existe el email');
            $newResponse = $response->withStatus(401);
            return $newResponse;
        }

    }

    public function mwImagen($response,$request,$next){
        $destino = "./img/";
        $response = $next($response,$request);

        if($response->getStatusCode() == 200){
            
            move_uploaded_file($_FILES['archivo']['tmp_name'], $destino);
           
        }
        else{
            echo 'todo mal';
        }
        return $response;
    }
}

?>