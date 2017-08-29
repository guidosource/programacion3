<?php

abstract class Persona
{
    //ATRIBUTOS
    var $nombre;
    var $apellido;
    var $sexo;

    public function __construct($nombre,$apellido,$sexo)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->sexo = $sexo;
    }

}


?>