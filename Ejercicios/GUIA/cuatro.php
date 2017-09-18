<?php
/*Aplicación Nº 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar
 los símbolos matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’;
  y definir dos variables enteras $op1 y $op2. 
  De acuerdo al símbolo que tenga la variable $operador,
   deberá realizarse la operación indicada y mostrarse el resultado por pantalla.
*/

echo Calculadora(5,6,"+");

function Calculadora($op1 , $op2, $operador)
{
    
    switch($operador)
    {
        case "+":
            return $op1 + $op2;
            break;
        case "-":
            return $op1 - $op2;
            break;
        case "/":
            if($op2 != 0)
                return $op1 / $op2;
            else
                return "Error. Division por 0."; 
            break;
        case "*":
            return $op1 * $op2;
            break;
        default:
            return "Operador inválido.";

    }

}




?>