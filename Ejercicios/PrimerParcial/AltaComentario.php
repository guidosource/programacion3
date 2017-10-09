<?php
include_once "Entidades/Comentario.php";

$userEmail = $_POST['email'];
$titulo = $_POST['titulo'];
$comentario = $_POST['comentario'];

$comentario = new Comentario($userEmail,$titulo,$comentario);

Comentario::AltaComentario($comentario);

?>