<?php
include_once "Usuario.php";

class Comentario
{
    
    public $userEmail;
    public $titulo;
    public $comentario;

    public function Comentario($userEmail, $titulo, $comentario)
    {

        $this->userEmail = $userEmail;
        $this->titulo = $titulo;
        $this->comentario = $comentario;
    }

    public static function AltaComentario($comentario)
    {

        if (Comentario::VerificarEmail($comentario->userEmail)) {
            $comentarioJson = json_encode($comentario);
            $pFile = fopen("./Archivos/comentarios.txt", "a");
            fwrite($pFile, $comentarioJson."\n");
            fclose($pFile);
            return true;
        } else {
            echo "No existe el email";
            return false;
        }
    }

    public static function AltaConImagen($comentario)
    {

        if (Comentario::AltaComentario($comentario)) {
            $extension = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
            $destino = "./Archivos/ImagenesDeComentario/".$comentario->titulo.".".$extension;
            move_uploaded_file($_FILES['archivo']['tmp_name'], $destino);
        }
    }

    public static function VerificarEmail($email)
    {

        $usuarios = Usuario::TraerUsuarios();

        foreach ($usuarios as $item) {
            if ($email == $item->email) {
                return true;
            }
        }
        return false;
    }

    public static function ArmarGrilla($email = NULL, $sabor = NULL)
    {
        $resultados = Comentario::Resultados($email, $sabor);     
        $grilla = "<table>
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Foto</th>
            </tr>
        </thead>";
        
        if($email != NULL && $titulo != NULL || $email == NULL && $titulo != NULL )
        {
            $grilla .= "<tbody>
            <td>".$resultados['titulo']."</td>
            <td>".$resultados['nombre']."</td>
            <td>".$resultados['edad']."</td>
            <td><img src='./Archivos/ImagenesDeComentario/".$resultados['titulo'].".jpg' width='100px' height='100px'></td>
            </tbody>";
            
        }
        else{
            foreach($resultados as $item){
                $grilla .= "<tbody>
                <td>".$item['titulo']."</td>
                <td>".$item['nombre']."</td>
                <td>".$item['edad']."</td>
                <td><img src='./Archivos/ImagenesDeComentario/".$item['titulo'].".jpg' width='100px' height='100px'></td>
                </tbody>";

            }
        }
        $grilla .= "</table>";
        echo $grilla;
        
    }

    public static function Resultados($email = NULL, $sabor = NULL)
    {
        if ($email != NULL && $sabor != NULL){
            $helados = Comentario::TraerComentarios();
            foreach ($comentarios as $item) {
                if ($item->userEmail == $email && $item->titulo == $titulo) {
                    $usuario = Usuario::BuscarUsuario($email);
                    $resultados = array("titulo"=>$item->titulo, "nombre"=>$usuario->nombre, "edad"=>$usuario->edad);
                    return $resultados;
                }
            }
            echo "No se encontraron resultados";
        }
        if ($email != NULL && $titulo == NULL){
            $comentarios = Comentario::TraerComentarios();
            $resultados = array();
            foreach ($comentarios as $item) {
                if ($item->userEmail == $email) {
                    $usuario = Usuario::BuscarUsuario($email);
                    array_push($resultados,array("titulo"=>$item->titulo, "nombre"=>$usuario->nombre, "edad"=>$usuario->edad));
                }
            }
            if(count($resultados) != 0)
            {
                return $resultados;
            }
            else{
                echo "No se encontraron resultados";
            }
        }
        if ($email == NULL && $titulo != NULL){
            $comentarios = Comentario::TraerComentarios();
            foreach ($comentarios as $item) {
                if ($item->titulo  == $titulo) {
                    $usuario = Usuario::BuscarUsuario($item->userEmail);
                    $resultados = array("titulo"=>$item->titulo, "nombre"=>$usuario->nombre, "edad"=>$usuario->edad);
                    return $resultados;
                }
            }
            echo "No se encontraron resultados";
        }
        if ($email == null && $titulo == null){
            $comentarios = Comentario::TraerComentarios();
            $resultados = array();
            foreach ($comentarios as $item) {
                {
                    $usuario = Usuario::BuscarUsuario($item->userEmail);
                    array_push($resultados,array("titulo"=>$item->titulo, "nombre"=>$usuario->nombre, "edad"=>$usuario->edad));   
                }
            }
            if(count($resultados) != 0)
            {
                return $resultados;
            }
            else{
                echo "No se encontraron resultados";
            }
        }
    }

    public static function TraerComentarios()
    {
        $comentarios = array();
        $pFile = fopen("./Archivos/comentarios.txt", "r");
        while (!feof($pFile)) {
            $aux = json_decode(fgets($pFile), true);
            array_push($comentarios, new Comentario($aux['userEmail'], $aux['titulo'], $aux['comentario']));
        }
        fclose($pFile);
        return $comentarios;
    }
}
