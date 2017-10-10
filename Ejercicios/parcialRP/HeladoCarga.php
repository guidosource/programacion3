<?php
include_once "Entidades/Helado.php";

$sabor = $_GET['sabor'];
$precio = $_GET['precio'];
$tipo = $_GET['tipo'];
$cantidad = $_GET['cantidad'];


$helado = new Helado($sabor,$precio,$tipo,$cantidad);
Helado::AltaHelado($helado);


?>