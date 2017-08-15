<?php
$miArray = [1,"Lunes","Dos","Sabado",5];
foreach ($miArray as $dato) {
    echo '<br> $dato';
}


array_push($miArray,"Guido");
array_push($miArray,$miArray);
//var_dump($miArray);
?> 