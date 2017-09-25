<?php
include_once "Estacionamiento.php";

$_auto1 = new Vehiculo("ABC 121");
$_auto2 = new Vehiculo("ABC 122");
$_auto3 = new Vehiculo("ABC 123");
$_auto4 = new Vehiculo("ABC 124");
$_auto5= new Vehiculo("ABC 125");
$_accion = "Sacar";

if($_accion == "Guardar")
{
    Estacionamiento::Guardar($_auto3);
}
else
{
    Estacionamiento::Sacar($_auto3);
}


?>