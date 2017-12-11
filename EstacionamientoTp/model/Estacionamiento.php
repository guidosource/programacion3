<?php
require_once 'AccesoDatos.php';

abstract class EstacionamientoEstados{
    const encurso = 'En curso';
    const finalizado = 'Finalizado';
}

class Estacionamiento{

    //registros de operaciones
    public $id;
    public $idEmpleadoIngreso;
    public $idCochera;
    public $fechaIngreso;
    public $idVehiculo;
    public $estado;
   //campos null

   public $idEmpleadoSalida;
   public $fechaSalida;
   public $importe;

   public function Alta()
   {
       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
       $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into estacionamiento (idEmpleadoIngreso,idCochera,fechaIngreso,idVehiculo,estado)values('$this->idEmpleadoIngreso','$this->idCochera','$this->fechaIngreso','$this->idVehiculo','$this->estado')");
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
       idVehiculo=:idVehiculo
       estado=:estado
       idEmpleadoSalida=:idEmpleadoSalida
       fechaSalida=:fechaSalida
       importe=:importe
       WHERE id=:id");
       $consulta->bindValue(':id',$this->id,PDO::PARAM_INT);
       $consulta->bindValue(':idEmpleadoIngreso',$this->idEmpleadoIngreso,PDO::PARAM_INT);
       $consulta->bindValue(':idCochera',$this->idCochera,PDO::PARAM_INT);
       $consulta->bindValue(':fechaIngreso',$this->fechaIngreso,PDO::PARAM_STR);
       $consulta->bindValue(':idVehiculo',$this->idVehiculo,PDO::PARAM_INT);
       $consulta->bindValue(':estado',$this->estado,PDO::PARAM_STR);
       $consulta->bindValue(':idEmpleadoSalida',$this->idEmpleadoSalida,PDO::PARAM_INT);
       $consulta->bindValue(':fechaSalida',$this->fechaSalida,PDO::PARAM_STR);
       $consulta->bindValue(':importe',$this->importe,PDO::PARAM_INT);
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
