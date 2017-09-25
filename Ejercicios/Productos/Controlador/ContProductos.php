<?php
include_once "../Modelo/Producto.php";

/* Recibe por post el nombre, el precio y tambien una foto del producto.
    Guardar la foto con el nombre del producto. 
*/

$accion = $_POST["accion"];

switch($accion){

    case "alta":

        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $archivo = $_FILES["archivo"]["name"];

        $extension = pathinfo($archivo,PATHINFO_EXTENSION); 
        $destino = "../Modelo/Imagenes/".$nombre.".".$extension;
        
        move_uploaded_file($_FILES["archivo"]["tmp_name"],$destino);

        $producto = new Producto($nombre,$precio,$destino);
        Producto::Alta($producto);
        
        break;

    case "baja":
        $producto = new Producto("cafe",34,"");
        Producto::Baja($producto);
        break;

    case "modificacion":


        break;

}






?>