<?php

require_once 'AccesoDatos.php';

class comentario{

    public $id;
    public $titulo;
    public $email;
    public $comentario;
    public $pathImagen;

    public function Alta(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into comentario (email,titulo,comentario,pathImagen)values('$this->email','$this->titulo','$this->comentario','$this->pathImagen')");
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

    public static function ObtenerUltimoId(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT MAX(id) AS id FROM comentario");
        $consulta->execute();			
        return $consulta->fetchAll();

    }

}