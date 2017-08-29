<?php

/*Se necesita tener el listado diez aulas, con los alumnos y el profesor a cargo,
Para buscar por nombre y/o apellido y/o sexo  :
Un alumno en todas las aulas.
Un alumno en un aula.
Un profesor en las aulas.
Cantidad de veces que aparece un alumno en las aulas.   
Una persona en las alulas.
Cantidad y listado de personas con el mismo apellido y/o nombre y/o sexo.

Se debe crear la jerarquía de clases, sabiendo que una de las clases es abstracta. 
*/
include "Persona.php";
class Alumno extends Persona
{
    public function __construct($nombre,$apellido,$sexo)
    {
        parent::__construct($nombre,$apellido,$sexo);
        
        
    }
}


?>