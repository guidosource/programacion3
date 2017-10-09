<?php
include_once "Entidades/Comentario.php";

$userEmail = $_POST['email'];
$tituloComen = $_POST['titulo'];

Comentario::ArmarGrilla($userEmail,$tituloComen);

?>