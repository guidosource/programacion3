<?php
include_once "Entidades/Usuario.php";

$email = $_POST['email'];
$clave = $_POST['clave'];

Usuario::VerificarUsuario($email,$clave);

?>