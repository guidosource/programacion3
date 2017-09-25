<?php
include_once "Estacionamiento.php";

$_auto1 = new Vehiculo("ABC 121");
$_auto2 = new Vehiculo("ABC 122");
$_auto3 = new Vehiculo("ABC 123");
$_auto4 = new Vehiculo("ABC 124");
$_auto5= new Vehiculo("ABC 125");
$_accion = "Guardar";

if($_accion == "Guardar")
{
    $estacionamiento = new Estacionamiento(50);
    $estacionamiento->GuardarVehiculo($_auto1);
    sleep(3);
    $estacionamiento->GuardarVehiculo($_auto2);
    sleep(6);
    $estacionamiento->GuardarVehiculo($_auto3);
    sleep(2);
    $estacionamiento->GuardarVehiculo($_auto4);
    sleep(9);
    $estacionamiento->GuardarVehiculo($_auto5);
}
else
{
    $estacionamiento = new Estacionamiento(50);
    $estacionamiento->SacarVehiculo($_auto4);
    $estacionamiento->SacarVehiculo($_auto3);
}


?>