<?php

include "Facultad.php";

$facultad = new Facultad();

$aulaUno = new Aula();
$aulaDos = new Aula();
$aulaTres = new Aula();
$aulaCuatro = new Aula();
$alumnoUno = new Alumno("Juan","Perez","Masculino");
$alumnoDos = new Alumno("Raul","Gomez","Masculino");
$alumnoTres = new Alumno("Maria","Ramirez","Femenino");
$alumnoCuatro = new Alumno("Camila","Vazquez","Femenino");
$alumnoCinco = new Alumno("Mariela","Estevez","Femenino");

$aulaUno->agregarAlumno($alumnoUno);
$aulaUno->agregarAlumno($alumnoDos);
$aulaDos->agregarAlumno($alumnoTres);
$aulaTres->agregarAlumno($alumnoCuatro);
$aulaCuatro->agregarAlumno($alumnoCinco);

array_push($aulas,$aulaUno,$aulaDos,$aulaTres,$aulaCuatro);
    
$resultado = buscarAlumnoAulas("Maria","Ramirez");
echo $resultado;

function buscarAlumnoAulas($nombre,$apellido)
{
    foreach($aulas as $valor)
    {
        foreach($valor->alumnos as $valorB)
        {
            if($valorB->nombre == $nombre || $valorB->apellido == $apellido)
            return $valorB;
        }        
    }
    echo "No se encontro el alumno";
    
}




?>