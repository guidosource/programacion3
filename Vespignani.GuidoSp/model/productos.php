<?php

require_once 'AccesoDatos.php';

class Productos{

    public $id;
    public $nombre;
    public $precio;


    public function Alta(){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into productos (nombre,precio)values('$this->nombre','$this->precio')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
                   

    }

    public function Modificar(){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE productos
        set nombre=:nombre,
        precio=:precio
        WHERE id=:id");
        $consulta->bindValue(':nombre',$this->nombre,PDO::PARAM_STR);
        $consulta->bindValue(':precio',$this->precio,PDO::PARAM_STR);
        $consulta->bindValue(':id',$this->id,PDO::PARAM_INT);
        return $consulta->execute();

    }

    public static function BajaPorId($id){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
        delete 
        from productos 				
        WHERE id=:id");	
        $consulta->bindValue(':id',$id, PDO::PARAM_INT);		
        $consulta->execute();
        return $consulta->rowCount();
    }

    public static function TraerTodos(){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id,nombre,precio FROM productos");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Productos");
    }

    public static function BuscarPorId($id){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id,nombre,precio FROM productos WHERE id=:id");
        $consulta->bindValue(':id',$id,PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Productos");

    }

}