<?php

$archivo = $_FILES['archivo']['name'];
var_dump($archivo);
$extension = pathinfo($archivo,PATHINFO_EXTENSION);
var_dump($extension);


?>