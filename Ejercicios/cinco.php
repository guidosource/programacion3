<?php

/*Aplicación Nº 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $numo
 pueda mostrarse por pantalla, el nombre del número que tenga dentro escrito
  con palabras, para los números entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.
*/

$num = 59;
echo NumerosEnLetras($num);

function NumerosEnLetras($num)
{
    if($num > 20 &&  $num < 60)
    {
        switch($num)
        {
            case $num < 30:
            $aux = $num - 20;
            switch($aux)
            {
                case $aux == 1:
                echo "Veintiuno";
                break;
                case $aux == 2:
                echo "Veintidos";
                break;
                case $aux == 3:        
                echo "Veintitres";
                break;
                case $aux == 4:
                echo "Veinticuatro";
                break;
                case $aux == 5:
                echo "Veinticinco";
                break;
                case $aux == 6:
                echo "Veintiseis";
                break;
                case $aux == 7:
                echo "Veintisiete";
                break;
                case $aux == 8:
                echo "Veintiocho";
                case $aux == 9:
                echo "Veintinueve";
                break; 
            }
            break;
            case $num < 40:
            $aux = $num - 30;
            switch($aux)
            {
                case $aux == 0:
                echo "Treinta";
                break;
                case $aux == 1:
                echo "Treinta y uno";
                break;
                case $aux == 2:
                echo "Treinta y dos";
                break;
                case $aux == 3:        
                echo "Treinta y tres";
                break;
                case $aux == 4:
                echo "Treinta y cuatro";
                break;
                case $aux == 5:
                echo "Treinta y cinco";
                break;
                case $aux == 6:
                echo "Treinta y seis";
                break;
                case $aux == 7:
                echo "Treinta y siete";
                break;
                case $aux == 8:
                echo "Treinta y ocho";
                case $aux == 9:
                echo "Treinta y nueve";
                break; 
            }
            break;
            case $num < 50:
            $aux = $num - 40;
            switch($aux)
            {
                case $aux == 0:
                echo "Cuarenta";
                break;
                case $aux == 1:
                echo "Cuarenta y uno";
                break;
                case $aux == 2:
                echo "Cuarenta y dos";
                break;
                case $aux == 3:        
                echo "Cuarenta y tres";
                break;
                case $aux == 4:
                echo "Cuarenta y cuatro";
                break;
                case $aux == 5:
                echo "Cuarenta y cinco";
                break;
                case $aux == 6:
                echo "Cuarenta y seis";
                break;
                case $aux == 7:
                echo "Cuarenta y siete";
                break;
                case $aux == 8:
                echo "Cuarenta y ocho";
                case $aux == 9:
                echo "Cuarenta y nueve";
                break; 
            }
            break;
            case $num < 60:
            $aux = $num - 50;
            switch($aux)
            {
                case $aux == 0:
                echo "Cincuenta";
                break;
                case $aux == 1:
                echo "Cincuenta y uno";
                break;
                case $aux == 2:
                echo "Cincuenta y dos";
                break;
                case $aux == 3:        
                echo "Cincuenta y tres";
                break;
                case $aux == 4:
                echo "Cincuenta y cuatro";
                break;
                case $aux == 5:
                echo "Cincuenta y cinco";
                break;
                case $aux == 6:
                echo "Cincuenta y seis";
                break;
                case $aux == 7:
                echo "Cincuenta y siete";
                break;
                case $aux == 8:
                echo "Cincuenta y ocho";
                case $aux == 9:
                echo "Cincuenta y nueve";
                break; 
            }
            break;
        }
    }
}


?>