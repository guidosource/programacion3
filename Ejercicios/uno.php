<?php

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