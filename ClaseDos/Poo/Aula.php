
<?php
include "Alumno.php";

class Aula
{
    var $alumnos = array();
    var $capacidadAula = 5;
    var $profesor;
   // $profesores;

    function agregarAlumno($alumno)
    {
        if($capacidadAula > array_count_values($alumnos))
        {
            array_push($this->alumnos,$alumno);
            return true;
        }
        else
        {
            return false;
        }
    }
        
        
    }
    function setProfesor($profesor)
    {
        $this->profesor = $profesor;
    }
    function getProfesor()
    {
        echo $profesor->nombre ," ", $profesor->apellido," ", $profesor->sexo, "<br>";
    }

    function mostrarAlumnos()
    {
      foreach($this->alumnos as $valor)
      {
          echo $valor->nombre ," ", $valor->apellido," ", $valor->sexo, "<br>";
      }
    }
    
}


?>