<?php
include_once "Alumno.php";
include_once "Profesor.php";

class Aula{

    private $_alumnos;
    private $_materia;
    private $_profesor;

    public function Aula($materia,$profesor){

        $this->_alumnos = array();
        $this->_materia = $materia;
        $this->_profesor = $profesor;
    }

    public function agregarAlumno($alumno){
    
        if(count($this->_alumnos) < 30){

            array_push($this->_alumnos,$alumno);
        }
        else{
            echo "El aula esta llena.";
        }
    }
    
    public function mostrarAlumnos(){

        $retorno = $this->_materia."<br>";

        foreach($this->_alumnos as $alumno){

            $retorno = $retorno.$alumno->toString()."<br>";
        }

        return $retorno;
    }

    public function buscarAlumno($legajo){

        foreach($this->_alumnos as $alumno){

            if($legajo == $alumno->getLegajo()){
                return true;
            }
        }
        return false;
    }
}


?>