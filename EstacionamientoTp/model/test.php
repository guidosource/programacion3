<?php

require_once 'Estacionamiento.php';
require_once 'Empleado.php';


$a = new Empleado();
$a->id = 34;
$a->nombre = 'raul';
$a->email = 'asd@asd';
$a->sexo = 'm';
$a->clave = '123asd';
$a->turno = 'manana';
$a->perfil = 'empleado';


$a->Modificar();
$b = Empleado::BuscarPorId(34);

var_dump($b);



?>