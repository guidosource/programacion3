<?php
class Usuario{

    public $nombre;
    public $email;
    public $perfil;
    public $edad;
    public $clave;

    public function Usuario($nombre,$email,$perfil,$edad,$clave){

        $this->nombre = $nombre;
        $this->email = $email;
        $this->perfil = $perfil;
        $this->edad = $edad;
        $this->clave = $clave;
    }

    public static function AltaUsuario($usuario){

        $usuarioJson = json_encode($usuario);
        $pFile = fopen("./Archivos/usuarios.txt","a");
        fwrite($pFile,$usuarioJson."\n");
        fclose($pFile);
    }

    public static function ModificarUsuario($usuario){
        //Trae los usuarios y modifica el usuario con valores nuevos.
        $usuarios = Usuario::TraerUsuarios();
        foreach($usuarios as $item){
            if($usuario->email == $item->email){
                $item = $usuario;
                break;
            }
        }
        //graba el archivo con el array de usuarios modificado.
        $pFile = fopen("./Archivos/usuarios.txt","w");
        foreach($usuarios as $item){
            fwrite($pFile,json_encode($item)."\n");
        }
        fclose($pFile);

    }

    public static function TraerUsuarios(){

        $usuarios = array();
        $pFile = fopen("./Archivos/usuarios.txt","r");
        while(!feof($pFile)){
            
            $aux = json_decode(fgets($pFile),TRUE);
            array_push($usuarios,new Usuario($aux['nombre'],$aux['email'],$aux['perfil'],$aux['edad'],$aux['clave']));
        }
        fclose($pFile);
        return $usuarios;
    }

    public static function BuscarUsuario($email){

        $usuarios = Usuario::TraerUsuarios();
        foreach($usuarios as $item){

            if($item->email == $email)
            return $item;
        }
        return NULL;
    }

    public static function VerificarUsuario($email,$clave){

        $usuarios = Usuario::TraerUsuarios();
        $existeEmail = false;

        foreach($usuarios as $item){

            if($item->email == $email){

                $existeEmail = true;
                if($item->clave == $clave){

                    echo "Bienvenido";
                    break;
                }
                else{
                    echo "Error de clave";
                    break;
                }
            }
        }
        if(!$existeEmail)
            echo "No existe el usuario";
    }
}

?>