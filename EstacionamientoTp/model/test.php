<?php

$prueba = date('Y-m-d H:i:s');
var_dump($prueba);
sleep(3);
$prueba2 = date('Y-m-d H:i:s');
$res = date_diff($prueba,$prueba2);
var_dump($res);

