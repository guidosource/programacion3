
<?php
include_once "Funciones.php";
require_once "FuncionesDos.php";
include_once "Entidades/Calculadora.php";
include_once "Validador/Validar.php";

$valobj = new Validar();

//echo $valobj->esCero(0);
Calculadora::Dividir(10,0);

//Calculadora::Multiplicar(100,100);

//$calobj = new Calculadora();
//$calobj->Multiplicar(5,5);

//Sumar(100,100);

//Restar(100,50);

var_dump

?>