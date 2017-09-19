
<?php
/*recibe por get el nombre del producto y la cantidad,
 hace llamadas a metodos y retorna el precio total a pagar
*/

include_once "Producto.php";

$nombre = $_GET["nombre"];
$cantidad = $_GET["cantidad"];
 
 $producto = verificarExistencia(Producto::retornarArrayDeProductos(),$nombre);
 if($producto != null){

    echo "Total a pagar ".totalAPagar($producto,$cantidad);
 }
 else{
     echo "No se encontro el producto";
 }


 function verificarExistencia($arrayProductos,$nombre){

    foreach($arrayProductos as $producto){

        if($producto->getNombre() == $nombre)
        return $producto;
    }
    return null;
 }

 function totalAPagar($producto , $cantidad){

    return ($producto->getPrecio() + $producto->precioMasIva($producto->getPrecio())) * $cantidad;
 }


 
 

 ?>