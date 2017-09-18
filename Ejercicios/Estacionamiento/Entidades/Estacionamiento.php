<?php
include_once "Vehiculo.php";

class Estacionamiento{

    private $_tarifaPorHora;

    public function Estacionamiento($tarifa){

        $this->_tarifaPorHora = $tarifa;
    }

    public function Guardar($auto){

        $archivo = fopen("./Archivos/Estacionados.txt","a");
        fwrite($archivo,$auto->patente."-".$auto->fIngreso."\n");
        fclose($archivo);

    }

    public function Sacar($auto){

        $archivo = fopen("./Archivos/Estacionados.txt","r+");
        if($archivo != false){

            //Aca se va a cargar el archivo-
            $lectura = array();

            while(!feof($archivo)){

                array_push($lectura,fgets($archivo));
            }

            $auto = buscarPorPatente($auto,$lectura);
            if($auto != null){
                
                

            }

        }
        else{
            echo "No se encontro el archivo Estacionados.txt";
        }
    }

    private function buscarPorPatente($auto,$lectura){
        
        $nuevoArchivo = array();
        $retorno = null;
        foreach($lectura as $item){

            //Auxiliar para separar la patente.
            $aux = explode("-",$item);
            if($auto->patente == $aux){

                $retorno = $auto;
            }
            else{
                array_push($nuevoArchivo,$item);
            }
        }
        $lectura = $nuevoArchivo;
        return retorno;       
    }

    private function calcularTarifa($auto)
    {
        fopen("./Archivos/Facturados.txt","a");
        $horaSalida = date("Y-m-d H:i:s");
        
    }
}

?>