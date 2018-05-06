<?php
require_once 'AccesoDatos.php';

class Vehiculo{

    public $id;
    public $patente;
    public $color;
    public $foto;
    public $marca;
    public $estacionado;

    public function Alta()
    {   
        $estacionado = (boolean)$this->estacionado;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into vehiculo (patente,color,foto,estacionado,marca)values('$this->patente','$this->color','$this->foto','$estacionado','$marca')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
               
    }

    public function Baja(){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
        delete 
        from vehiculo 				
        WHERE id=:id");	
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
        $consulta->execute();
        return $consulta->rowCount();
    }
        
    public function Modificar(){
        $estado = (boolean)$this->estado;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE vehiculo set
        patente=:patente
        color=:color
        foto=:foto
        marca=:marca
        estacionado=:estacionado
        WHERE id=:id");
        $consulta->bindValue(':id',$this->id,PDO::PARAM_INT);
        $consulta->bindValue(':patente',$this->patente,PDO::PARAM_STR);
        $consulta->bindValue(':color',$this->color,PDO::PARAM_STR);
        $consulta->bindValue(':foto',$this->foto,PDO::PARAM_STR);
        $consulta->bindValue(':estacionado',$estado,PDO::PARAM_BOOL);
        $consulta->bindValue(':marca',$marca,PDO::PARAM_STR);
        return $consulta->execute();
    }
        
    public static function BajaPorId($id){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
        delete 
        from vehiculo 				
        WHERE id=:id");	
        $consulta->bindValue(':id',$id, PDO::PARAM_INT);		
        $consulta->execute();
        return $consulta->rowCount();
    }
        
    public static function TraerTodos(){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from vehiculo");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Vehiculo");
    }
        
    public static function BuscarPorId($id){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM vehiculo WHERE id=:id");
        $consulta->bindValue(':id',$id,PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Vehiculo");

    }

    public static function traerEstacionados(){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM vehiculo WHERE estacionado=1");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Vehiculo");
    }

}



?>