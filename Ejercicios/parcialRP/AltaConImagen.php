<?php
include_once "Entidades/Helado.php";

$sabor = $_POST['sabor'];
$tipo = $_POST['tipo'];
$email = $_POST['email'];
$cantidad = $_POST['cantidad'];

Helado::AltaConImagen($email,$sabor,$tipo,$cantidad);


?>