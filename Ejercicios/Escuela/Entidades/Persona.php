<?php
abstract class Persona{

    protected $_nombre;
    protected $_apellido;
    protected $_sexo;

    public function Persona($nombre, $apellido, $sexo){

        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
        $this->_sexo = $sexo;
    }

    public function getNombre(){

        return $this->_nombre;
    }

    public function setNombre($nombre){

        $this->_nombre = $nombre;
    }

    public function getApellido(){

        return $this->_apellido;
    }

    public function setApellido($apellido){

        $this->_apellido = $apellido;
    }
    
    public function getSexo(){

        return $this->_sexo; 
    }

    public function setSexo($sexo){

        $this->_sexo = $sexo;
    }

    public function toString(){

        return $this->getApellido()." ".$this->getNombre()." ".$this->getSexo();
    }

    

}


?>