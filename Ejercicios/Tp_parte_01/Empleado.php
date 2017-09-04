<?php
include_once "Persona.php";

class Empleado extends Persona
{
    protected $_legajo;
    protected $_sueldo;

    public function __construct($nombre, $apellido,$dni, $sexo, $legajo, $sueldo)
     {
         parent::__construct($nombre,$apellido,$dni,$sexo);
         $this->_legajo = $legajo;
         $this->_sueldo = $sueldo;
     }

     public function Hablar($idioma)
     {
         return "El empleado habla ".$idioma;
     }

     public function toString()
     {
        return parent::toString()."-".$this->_legajo."-".$this->_sueldo;
     }

     public function GetSueldo()
     {
        return $this->_sueldo;      
     }

     public function GetLegajo()
     {
         return $this->legajo;
     }
}


?>


