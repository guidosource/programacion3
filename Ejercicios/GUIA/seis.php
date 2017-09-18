<?php
/*
Aplicación Nº 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número
 (utilizar la función rand). Mediante una estructura condicional,
  determinar si el promedio de los números son mayores, menores o iguales que 6.
   Mostrar un mensaje por pantalla informando el resultado.


*/
$array = array(rand(1,10),rand(1,10),rand(1,10),rand(1,10),rand(1,10));
$promedio = ($array[0]+ $array[1] + $array[2] + $array[3] + $array[4])/5;
if($promedio > 6)
echo "El promedio es mayor a 6";
else if($promedio == 6)
echo "El promedio es igual a 6";
else if($promedio < 6)
echo "El promedio es menor a 6"; 


?>