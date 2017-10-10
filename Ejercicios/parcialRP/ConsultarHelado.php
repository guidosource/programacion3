<?php
include_once "Entidades/Helado.php";

$sabor = $_POST['sabor'];
$tipo = $_POST['tipo'];

Helado::BuscarHelado($sabor,$tipo);


?>