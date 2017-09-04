<?php
include_once "Empleado.php";
class Fabrica
{
    private $_empleados;
    private $_razonSocial;

    public function __construct($razonSocial)
    {
        $this->_razonSocial = $razonSocial;
        $this->_empleados = array();
    }
    
    public function AgregarEmpleado($empleado)
    {
        array_push($this->_empleados,$empleado);
        $this->_empleados = $this->EliminarEmpleadosRepetidos();
    }

    public function CalcularSueldos()
    {
        $sueldos = 0;
        foreach($this->_empleados as $empleado)
        {
            $sueldos = $sueldos + $empleado->GetSueldo();
        }
        return $sueldos;
    }

    public function EliminarEmpleados($empleado)
    {
        for($i = 0; $i<count($this->_empleados);$i++)
        {
            if($this->_empleados[$i] == $empleado)
                unset($this->_empleados[$i]);
        }
    }

    private function EliminarEmpleadosRepetidos()
    {
        return array_unique($this->_empleados,SORT_REGULAR);
    }

    public function toString()
    {
        $retorno = "";
        foreach($this->_empleados as $empleado)
        {
            $retorno = $retorno."-".$empleado->toString()."<br>";
        }
        return $retorno;
    }
}


?>