<?php

/* Recibe por post el nombre, el precio y tambien una foto del producto.
    Guardar la foto con el nombre del producto. 
*/

$nombre = $_POST["nombre"];
$precio = $_POST["precio"];
$destino = "imagenes/" .$_FILES["archivo"]["name"];
move_uploaded_file($_FILES["archivo"]["name"],$destino);



?>

