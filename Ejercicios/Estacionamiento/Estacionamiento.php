<?php
include_once "Vehiculo.php";
class Estacionamiento{

    private $_tarifa;

    public function Estacionamiento($tarifa){

        $this->_tarifa = $tarifa;
    }

    public function GuardarVehiculo($vehiculo){

        $archivo = fopen("Datos/Estacionados.txt","a");
        var_dump($archivo);
        die();
        $fecha = date("d M Y H:i:s");
        fwrite($archivo,$vehiculo->_patente."-".$fecha."\n");
        fclose($archivo);
    }

    public function SacarVehiculo($vehiculo){

        $fechaEntrada = null;
        $estacionados = $this->BuscarVehiculo($vehiculo->_patente,$fechaEntrada);
        
        if($estacionados != null){

            $archivo = fopen("Datos/Estacionados.txt","w");
            var_dump($archivo);
            die();
            foreach($estacionados as $linea){
                //var_dump($linea);
                //die();
                fwrite($archivo,$linea);
                fclose($archivo);
            }

            $archivo = fopen("Datos/Facturados.txt","a");
            $horaSalida = date("d M Y H:i:s");
            $tarifa = CalcularTarifa($fechaEntrada,$horaSalida);
            fwrite($archivo,$vehiculo->_patente."-".$horaSalida."-A pagar: ".$tarifa."\n");
            fclose($archivo);
        }

    }

    public function BuscarVehiculo($patente,$fecha){

        $archivo = fopen("Datos/Estacionados.txt","r");
        $estacionados = array();
        $encontrado = false;
        while(!feof($archivo)){

            $aux = fgets($archivo);
            $cmpPatente = explode("-",$aux);
            if($cmpPatente[0] == $patente){
                $encontrado = true;
                $fecha = $cmpPatente[1];
            }
            else{
                array_push($estacionados,$aux);
            }
        }
        fclose($archivo);

        if($encontrado){
            return $estacionados;
        }
        else{
            return null;
        }
    }

    public function CalcularTarifa($fechaEntrada,$fechaSalida){

        $tiempoDeUso = strtotime($fechaSalida) - strtotime($fechaEntrada);
        $horas = $tiempoDeUso / 3600;
        
        return ceil($horas) * $this->_tarifa;
    }
}

?>