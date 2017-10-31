<?php
require_once 'AccesoDatos.php';

class Estacionamiento{

    private $_patente;
    private $_color;
    private $_foto;
    private $_idEmpleadoE;
    private $_fechaIngreso;

    //campos null
    private $_idEmpleadoS;
    private $_fechaSalida;
    private $_importe;
    private $_tiempo;

    public function Estacionamiento($patente,$color,$foto,$idEmpleadoE,$fechaIngreso,$idEmpleadoS = null,$fechaSalida = null,$importe = null,$tiempo = null){

        $this->_patente = $patente;
        $this->_color = $color;
        $this->_foto = $foto;
        $this->_idEmpleadoE = $idEmpleadoE;
        $this->fechaIngreso = $fechaIngreso;

    }

    public static function TraerTodoLosCds()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,titel as titulo, interpret as cantante,jahr as año from cds");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "cd");		
	}

}


?>
