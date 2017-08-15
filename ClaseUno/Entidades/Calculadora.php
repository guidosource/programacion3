<?php

include_once "/../Validador/Validar.php";

 class Calculadora
{
    static function Multiplicar($numeroUno,$numeroDos)
    {
        echo $numeroUno * $numeroDos;
    }
    static function Dividir($numUno,$numDos)
    {
        $valobj = new Validar();
        if(!($valobj->esCero($numDos)))
        {
            echo $numUno / $numDos;
        }
        else
        {
            echo "No se puede dividir";
        }

    }   
}



?>