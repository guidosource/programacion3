<?php
require_once 'AccesoDatos.php';

class Estacionamiento{

    public $_patente;
    public $_color;
    public $_foto;
    public $_idEmpleadoE;
    public $_fechaIngreso;

    //campos null
    public $_idEmpleadoS;
    public $_fechaSalida;
    public $_importe;
    public $_tiempo;

    /*
    public function Estacionamiento($patente,$color,$foto,$idEmpleadoE,$fechaIngreso,$idEmpleadoS = null,$fechaSalida = null,$importe = null,$tiempo = null){

        $this->_patente = $patente;
        $this->_color = $color;
        $this->_foto = $foto;
        $this->_idEmpleadoE = $idEmpleadoE;
        $this->fechaIngreso = $fechaIngreso;

    }
    */
    
    public static function TraerTodosLosRegistros()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from estacionamiento");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Estacionamiento");		
	}

}


?>
