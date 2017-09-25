<?php
include_once "Persona.php";

class Alumno extends Persona{

    private $_legajo;

    public function Alumno($nombre,$apellido,$sexo,$legajo){

        parent::__construct($nombre,$apellido,$sexo);

        $this->_legajo = $legajo;
    }

    public function getLegajo(){

        return $this->_legajo;
    }

    public function toString(){

        return parent::toString()." ".$this->getLegajo();
    }


}

?>