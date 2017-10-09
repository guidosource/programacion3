<?php
include_once "Entidades/Comentario.php";

$userEmail = $_POST['email'];
$titulo = $_POST['titulo'];
$comentario = $_POST['comentario'];

$coment = new Comentario($userEmail,$titulo,$comentario);

Comentario::AltaConImagen($coment);


?>