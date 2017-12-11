<?php
require_once "AccesoDatos.php";

class Administracion{

    public $id;
    public $nombreEstacionamiento;
    public $tarifaHora;
    public $tarifaMediaEstadia;
    public $tarifaEstadia;

    public function Inicio(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into administracion (tarifaHora,nombreEstacionamiento,tarifaMediaEstadia,tarifaEstadia)values('$this->tarifaHora','$this->nombreEstacionamiento','$this->tarifaMediaEstadia','$this->tarifaEstadia')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function ModificarDatos(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE administracion
        set tarifaHora=:tarifaHora,
        nombreEstacionamiento=:nombreEstacionamiento,
        tarifaMediaEstadia=:tarifaMediaEstadia
        tarifaEstadia=:tarifaEstadia
        WHERE id=:id");
        $consulta->bindValue(':id',$this->id,PDO::PARAM_INT);
        $consulta->bindValue(':nombreEstacionamiento',$this->nombreEstacionamiento,PDO::PARAM_STR);
        $consulta->bindValue(':tarifaHora',$this->tarifaHora,PDO::PARAM_STR);
        $consulta->bindValue(':tarifaMediaEstadia',$this->tarifaMediaEstadia,PDO::PARAM_STR);
        $consulta->bindValue(':tarifaEstadia',$this->tarifaEstadia,PDO::PARAM_STR);
        return $consulta->execute();
    }

    public function TarifaHora(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT tarifaHora FROM administracion");
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function TarifaMediaEstadia(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT tarifaMediaEstadia FROM administracion");
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function TarifaEstadia(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT tarifaEstadia FROM administracion");
        $consulta->execute();
        return $consulta->fetchAll();
    }
}

?>