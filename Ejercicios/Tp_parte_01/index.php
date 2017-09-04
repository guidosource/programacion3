<?php
include_once "Empleado.php";
include_once "Fabrica.php";

$e1 = new Empleado("juam","gomez","23009212","masculino",32,3000);
$e2 = new Empleado("maria","rodriguez","3321234","femenino",44,5000);
$fabrica1 = new Fabrica("UTN");
$fabrica1->AgregarEmpleado($e1);
$fabrica1->AgregarEmpleado($e2);
$fabrica1->AgregarEmpleado($e2);
$fabrica1->AgregarEmpleado($e2);

echo $fabrica1->toString();
echo "<br>";
echo $fabrica1->CalcularSueldos();
$fabrica1->EliminarEmpleados($e1);
echo $fabrica1->toString();

?>