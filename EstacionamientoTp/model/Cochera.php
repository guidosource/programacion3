<?php
require_once "AccesoDatos.php";

abstract class CocheraEstados{
    const disponible = 'Disponible';
    const ocupado = 'Ocupado';
}

class Cochera{
    
    public $id;
    public $idVehiculo;
    public $prioridad;
    public $estado;

    public function Alta(){
        $prioridad = (boolean)$this->prioridad;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into cochera (idVehiculo,prioridad,estado)values('$this->idVehiculo','$prioridad','$this->estado')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
                    
    }
        
    public function Baja(){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
        delete 
        from cochera 				
        WHERE id=:id");	
        $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
        $consulta->execute();
        return $consulta->rowCount();
    }
        
    public function Modificar(){
        $prioridad = (boolean)$this->prioridad;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE cochera
        set idVehiculo=:idVehiculo,
        prioridad=:prioridad,
        estado=:estado
        WHERE id=:id");
        $consulta->bindValue(':id',$this->id,PDO::PARAM_INT);
        $consulta->bindValue(':idVehiculo',$this->idVehiculo,PDO::PARAM_STR);
        $consulta->bindValue(':prioridad',$prioridad,PDO::PARAM_BOOL);
        $consulta->bindValue(':estado',$this->estado,PDO::PARAM_STR);
        return $consulta->execute();
    }
        
    public static function BajaPorId($id){
                
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
        delete 
        from cochera 				
        WHERE id=:id");	
        $consulta->bindValue(':id',$id, PDO::PARAM_INT);		
        $consulta->execute();
        return $consulta->rowCount();
    }
        
    public static function TraerTodos(){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select * from cochera");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Cochera");
    }

    public static function BuscarPorId($id){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM cochera WHERE id=:id");
        $consulta->bindValue(':id',$id,PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Cochera");

    }
    public static function BuscarLugar(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM cochera WHERE estado = 'Disponible' LIMIT 1");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Cochera");
    }

    public static function BuscarSimple(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM cochera WHERE prioridad = 0 AND estado = 'Disponible' LIMIT 1");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Cochera");
    }
    
    public static function BuscarPrioritaria(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM cochera WHERE prioridad = 1 AND estado = 'Disponible' LIMIT 1");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Cochera");
    }


}



?>