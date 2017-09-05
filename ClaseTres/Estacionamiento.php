<?php
include_once "Vehiculo.php";

class Estacionamiento
{
    public static function Guardar($auto)
    {
        echo "Estoy guardando";
        $ahora = date("Y-m-d H:i:s");
       // $auto->patente = $auto->patente.$ahora;
        
        $archivo = fopen("Archivos/Estacionados.txt","a");
        fwrite($archivo,$auto->patente."-".$ahora."\n");
        fclose($archivo);
    }

    public static function Sacar($auto)
    {
        $archivo = fopen("Archivos/Estacionados.txt","r");
        $lectura = array();

        while(!feof($archivo))
		{
            array_push($lectura,fgets($archivo));
            foreach($lectura as $linea)
            {
                $aux = explode("-",$linea);
                if($auto->_patente == $aux[0])
                {
                   $patenteEncontrada = $auto->patente;
                }
                else
                {
                    $estacionados = array();
                    array_push($estacionados,$linea);
                }
            }
		}
		fclose($archivo);
        //Abro Facturados.txt
        $archivo = fopen("Archivos/Facturados.txt","a");
        $ahora = date("Y-m-d H:i:s");
        fwrite($archivo,$patenteEncontrada."-".$ahora."\n");
        fclose($archivo);

        //Nuevo Estacionamiento.txt
        $archivo = fopen("Archivos/Estacionados.txt","w");
        foreach($estacionados as $item)
        {
            fwrite($archivo,$item);
        }
        fclose($archivo);
        
        echo "Estoy sacando";
    }
}


?>

