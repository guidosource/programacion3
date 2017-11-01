<?php
require_once 'AccesoDatos.php';

class Vehiculo{

    public $id;
    public $patente;
    public $color;
    public $foto;

    public function InsertarVehiculo()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into vehiculo (patente,color,foto)values('$this->patente','$this->color','$this->foto')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
               
    }

}



?>