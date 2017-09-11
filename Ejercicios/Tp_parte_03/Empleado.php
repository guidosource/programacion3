<?php   
include_once "Persona.php";

class Empleado extends Persona
{
    protected $_legajo;
    protected $_sueldo;
    protected $_pathFoto;

    public function Empleado($apellido,$nombre,$dni,$sexo,$legajo,$sueldo)
    {
        parent::__construct($apellido,$nombre,$dni,$sexo);
        $this->_legajo = $legajo;
        $this->_sueldo = $sueldo;
    }

    public function Hablar($idioma)
    {
        return "El empleado habla ".$idioma;
    }

    public function ToString()
    {
       return parent::ToString()."-".$this->_legajo."-".$this->_sueldo;
    }

    public function GetSueldo()
    {
       return $this->_sueldo;      
    }

    public function GetLegajo()
    {
        return $this->legajo;
    }

    public function GetPathFoto()
    {
        return $this->_pathFoto;
    }
}




?>