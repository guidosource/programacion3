<?php
require_once 'AccesoDatos.php';

class usuario{

    public $id;
    public $nombre;
    public $email;
    public $clave;
    public $perfil;
    public $edad;

    public function Alta(){
        $pass = sha1($this->clave); // encripta la clave en sha;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre,email,perfil,edad,clave)values('$this->nombre','$this->email','$this->perfil','$this->edad','$pass')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
                   
    }

    public function Baja(){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete 
            from usuarios				
            WHERE id=:id");	
            $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
            $consulta->execute();
            return $consulta->rowCount();
    }

    public function Modificar(){

        $pass = sha1($this->clave); // encripta la clave en sha;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE usuarios
        set nombre=:nombre,
        email=:email,
        perfil=:perfil,
        edad=:edad,
        clave=:clave
        WHERE id=:id");
        $consulta->bindValue(':id',$this->id,PDO::PARAM_INT);
        $consulta->bindValue(':nombre',$this->nombre,PDO::PARAM_STR);
        $consulta->bindValue(':email',$this->email,PDO::PARAM_STR);
        $consulta->bindValue(':perfil',$this->perfil,PDO::PARAM_STR);
        $consulta->bindValue(':clave',$pass,PDO::PARAM_STR);
        $consulta->bindValue(':edad',$this->edad,PDO::PARAM_STR);
        return $consulta->execute();

    }

    public static function TraerTodos(){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id,nombre,email,perfil,clave,edad FROM usuarios");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS,"usuario");
    }

    public static function BuscarPorId($id){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id,nombre,email,perfil,clave,edad FROM usuarios WHERE id=:id");
        $consulta->bindValue(':id',$id,PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"usuarios");

    }

    public static function BuscarPorEmailClave($email,$clave){
        
        $pass = sha1($clave); // encripta la clave en sha;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id,nombre,email,perfil,clave,edad FROM usuarios WHERE email=:email AND clave=:clave");
        $consulta->bindValue(":email",$email,PDO::PARAM_STR);
        $consulta->bindValue(":clave",$pass,PDO::PARAM_STR);
        $consulta->execute();
        $retorno = $consulta->fetchAll(PDO::FETCH_CLASS,"usuario");
        return $retorno;        
    }

    public static function BuscarPorEmail($email){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id,nombre,email,perfil,clave,edad FROM usuarios WHERE email=:email");
        $consulta->bindValue(":email",$email,PDO::PARAM_STR);
        $consulta->execute();
        $retorno = $consulta->fetchAll(PDO::FETCH_CLASS,"usuario");
        return $retorno;
    }


}





?>