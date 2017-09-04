<?php
include_once "FiguraGeometrica.php";

class Rectangulo  extends FiguraGeometrica
{
    private $_ladoDos;
    private $_ladoUno;
    
   
    public function __construct($l1,$l2)
     {
        //parent::__construct();
        
        $this->_ladoUno = $l1;
        $this->_ladoDos = $l2;
        $this->CalcularDatos(); 
     }

     function CalcularDatos()
     {
         $this->_perimetro = ($this->_ladoUno * 2) + ($this->_ladoDos * 2);
         $this->_superficie = $this->_ladoUno * $this->_ladoDos;
         
     }

    public function Dibujar()
    {
         return "<br>"."************"."</br>"."<br>"."*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*"."</br>"."<br>"."*&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*"."</br>"."<br>"."************";
    }
}

?>