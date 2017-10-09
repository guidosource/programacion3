<?php
include_once "Entidades/Usuario.php";

$nombre = $_GET['nombre'];
$perfil = $_GET['perfil'];
$email = $_GET['email'];
$edad = $_GET['edad'];
$clave = $_GET['clave'];

$usuario = new Usuario($nombre,$email,$perfil,$edad,$clave);
Usuario::AltaUsuario($usuario);


?>