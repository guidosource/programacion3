<?php
include "Aula.php";

class Facultad
{
    //ATRIBUTOS
    private $aulas = array();
    private $alumnos = array();
    
    function CrearAula()
    {
        array_push($aulas,new Aula());
    }
    function IngresarAlumno($alumno)
    {
        array_push($alumnos,$alumno);
    }
    function UbicarAlumnos()
    {
        $aux;
        foreach($this->aulas as $itemAula)
        
    }

}



?>