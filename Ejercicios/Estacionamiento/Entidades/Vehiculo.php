<?php

class Vehiculo
{
    public $patente;
    public $fIngreso;

    public function Vehiculo($patente){

        $this->patente = $patente;
        $this->fIngreso = date("Y-m-d H:i:s");
    }



}

?>