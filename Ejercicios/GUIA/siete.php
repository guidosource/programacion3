<?php
/*
Aplicación Nº 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un 
Array. Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). 
Repetir la impresión de los números utilizando las estructuras while y foreach.
*/

$array = array();
$contador = 0;

while($contador < 10)
{
    $num = rand();
    if($num % 2 != 0)
    { 
        array_push($array,$num);
        $contador++;
    }
}

for($i = 0; $i<count($array); $i++)
{
    echo "<br>".$array[$i]."<br/>";    
}




?>
