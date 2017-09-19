
<?php

/*
PPSEE DOS ATRIBUTOS PRIVADOS IMPLEMENTA LA INTERFAZ IVENDIBLE CON EL PRECIO MAS IVA
 Y TIENE UN AMETODO QUE SE LLAMMA RETORNAR ARRAY DE PRODUCTOS QUE RETORNA UN ARRAY
  CON 5 PRODUCTOS


*/

interface IVendible{

    public  function precioMasIva($precio);
    public static function retornarArrayDeProductos();

}


class Producto implements IVendible{

    private $_nombre;
    private $_precio;

    public function getNombre(){

        return $this->_nombre;
    }

    public function getPrecio(){

        return $this->_precio;
    }

    public function Producto($nombre,$precio){

        $this->_nombre = $nombre;
        $this->_precio = $precio;
    }
    
    public function precioMasIva($precio) {

        return ($precio*0.21);
    }

    public static function retornarArrayDeProductos() {
        
        $retorno = array();
        
        $productoUno = new Producto("Cafe",80);
        $productoDos = new Producto("Te",20);
        $productoTres = new Producto("Mermelada",40);
        $productoCuatro = new Producto("Pan",50);
        $productoCinco = new Producto("Chocolate",25);

        array_push($retorno,$productoUno);
        array_push($retorno,$productoDos);
        array_push($retorno,$productoTres);
        array_push($retorno,$productoCuatro);
        array_push($retorno,$productoCinco);

        return $retorno;

    }


}


?>