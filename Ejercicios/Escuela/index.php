<?php
include_once "Entidades/Aula.php";


$alumno1= new Alumno("Juan","Perez","Masculino",1);
$alumno2= new Alumno("Maria","Martinez","Femenino",2);
$profesor = new Profesor("Cristian","Gonzalez","Masculino",128);
$aula = new Aula("Matematicas",$profesor);
$aula->agregarAlumno($alumno1);
$aula->agregarAlumno($alumno2);

echo $aula->mostrarAlumnos();

?>