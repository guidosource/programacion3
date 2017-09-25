<?php
include_once "Persona.php";

class Profesor extends Persona{

    private $_matricula;

    public function Profesor($nombre,$apellido,$sexo,$matricula){

        parent::__construct($nombre,$apellido,$sexo);

        $this->_matricula = $matricula;
    }

    public function getMatricula(){

        return $this->_matricula;
    }

    public function toString(){

        return parent::toString()." ".$this->getMatricula();
    }
}


?>