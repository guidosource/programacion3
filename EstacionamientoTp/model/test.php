<?php

require_once 'Estacionamiento.php';
require_once 'Empleado.php';


$a = new Empleado('juan','juam@','m','123','tarde','empleado','34');

//$a->Modificar();

$b = Empleado::Listar();
var_dump($b);



?>