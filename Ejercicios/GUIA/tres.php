<?php


/*Aplicación Nº 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido.
Ejemplo 1: $a = 6; $b = 9; $c = 8; => se muestra 8.
Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”
*/

$a =17;
$b = 17;
$c =17;

echo MostrarMedio($a,$b,$c);

function MostrarMedio($a , $b ,$c)
{
    if($a > $b && $a < $c || $a > $c && $a < $b )
        return $a;
    else if($b > $a && $b < $c || $b > $c && $b < $a)
        return $b;
    else if($c > $a && $c < $b || $c > $b && $c < $a)
        return $c;
    else
        return "No hay valor del medio.";
}

    
?>