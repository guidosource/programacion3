<?php
require_once 'AccesoDatos.php';

class Estacionamiento{

    //registros de operaciones
    public $id;
    public $idEmpleadoIngreso;
    public $idCochera;
    public $fechaIngreso;

   //campos null
   public $idEmpleadoSalida;
   public $fechaSalida;

    public static function DefinirNombreCapacidad($nombre,$capacidad){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT into administracion (capacidad,nombre)values('$nombre','$capacidad')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function ObtenerCapacidad(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT cantidad FROM administracion LIMIT 1");
        $consulta->execute();
        return $objetoAccesoDato->fetchAll();

    }

   public function Alta()
   {
       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
       $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into estacionamiento (idEmpleadoIngreso,idCochera,fechaIngreso)values('$this->idEmpleadoIngreso','$this->idCochera','$this->fechaIngreso')");
       $consulta->execute();
       return $objetoAccesoDato->RetornarUltimoIdInsertado();              
   }

   public function Baja(){
       
       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
       $consulta =$objetoAccesoDato->RetornarConsulta("
       delete 
       from estacionamiento 				
       WHERE id=:id");	
       $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
       $consulta->execute();
       return $consulta->rowCount();
   }
       
   public function Modificar(){

       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
       $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE estacionamiento set
       idEmpleadoIngreso=:idEmpleadoIngreso
       idCochera=:idCochera
       fechaIngreso=:fechaIngreso
       WHERE id=:id");
       $consulta->bindValue(':id',$this->id,PDO::PARAM_INT);
       $consulta->bindValue(':idEmpleadoIngreso',$this->idEmpleadoIngreso,PDO::PARAM_INT);
       $consulta->bindValue(':idCochera',$this->idCochera,PDO::PARAM_INT);
       return $consulta->execute();
   }
       
   public static function BajaPorId($id){
       
       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
       $consulta =$objetoAccesoDato->RetornarConsulta("
       delete 
       from estacionamiento 				
       WHERE id=:id");	
       $consulta->bindValue(':id',$id, PDO::PARAM_INT);		
       $consulta->execute();
       return $consulta->rowCount();
   }
       
   public static function TraerTodos(){

       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
       $consulta =$objetoAccesoDato->RetornarConsulta("select * from estacionamiento");
       $consulta->execute();			
       return $consulta->fetchAll(PDO::FETCH_CLASS,"Estacionamiento");
   }
       
   public static function BuscarPorId($id){

       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
       $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM estacionamiento WHERE id=:id");
       $consulta->bindValue(':id',$id,PDO::PARAM_INT);
       $consulta->execute();
       return $consulta->fetchAll(PDO::FETCH_CLASS,"Estacionamiento");

   }

}


?>
