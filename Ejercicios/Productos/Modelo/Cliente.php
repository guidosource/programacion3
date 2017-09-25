<?php
class Cliente{

    private $_nombre;
    private $_apellido;
    private $_mail;
    private $_clave;

    public function Cliente($nombre,$apellido,$mail,$clave){

        $this->_apellido = $apellido;
        $this->_nombre = $nombre;
        $this->_mail = $mail;
        $this->_clave = $clave;
    }


}


?>

