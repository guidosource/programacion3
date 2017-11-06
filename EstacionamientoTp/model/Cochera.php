<?php
require_once "AccesoDatos.php";

class Cochera{
    
    public $id;
    public $idVehiculo;
    public $especial;
    public $disponible;

    public function Alta(){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into cochera (idVehiculo,especial,disponible)values('$this->idVehiculo','$this->especial','$this->disponible')");
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

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE cochera
        set idVehiculo=:idVehiculo,
        especial=:especial,
        disponible=:disponible
        WHERE id=:id");
        $consulta->bindValue(':id',$this->id,PDO::PARAM_INT);
        $consulta->bindValue(':idVehiculo',$this->idVehiculo,PDO::PARAM_STR);
        $consulta->bindValue(':especial',$this->especial,PDO::PARAM_STR);
        $consulta->bindValue(':disponible',$this->disponible,PDO::PARAM_STR);
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


}



?>