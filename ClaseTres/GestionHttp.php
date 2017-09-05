<?php


//$_GET;
//var_dump($_GET);
echo ("Hola HTTP");
$_POST;
var_dump($_POST);

$_patente = $_POST["patente"];
$_accion = $_POST["accion"];

if($_accion == "Guardar")
{
   // Estacionamiento::Guardar($_auto5);
   echo ("Guardando");
}
else
{
    echo ("Sacando");
   // Estacionamiento::Sacar($_auto1);
}


?>