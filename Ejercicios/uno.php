<?php

/*Aplicación Nº 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras 
la suma no supere a 1000. Mostrar los números sumados y al finalizar 
el proceso indicar cuantos números se sumaron.
*/

$num = 1;
$sumTotal = 0;
$contador = 0;

while($sumTotal <= 1000)
{
    $sumTotal = $sumTotal + $num;
    echo "Suma total: " , $sumTotal, "<br>";
    $contador++;
    $num++;   
}

echo "Cantidad de numero sumados: " , $contador;


?>