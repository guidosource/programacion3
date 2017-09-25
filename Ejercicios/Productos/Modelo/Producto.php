<?php
interface iVendible{

    function PrecioMasIva($precio);
}

class Producto implements iVendible{

    public $_nombre;
    public $_precio;
    public $_pathFoto;

    public function SetNombre($nombre){

        $this->_nombre = $nombre;
    }

    public function SetPrecio($precio){

        $this->_precio = $this->PrecioMasIva($precio);
    }

    public function SetPathFoto($path){

        $this->_pathFoto = $path;
    }

    public function GetNombre(){

        return $this->_nombre;
    }

    public function GetPrecio(){

        return $this->_precio;
    }

    public function GetPathFoto(){

        return $this->_pathFoto;
    }
    

    public function Producto($nombre,$precio,$path){

        $this->SetNombre($nombre);
        $this->SetPrecio($precio);
        $this->SetPathFoto($path);
    }

    function PrecioMasIva($precio){

        return $precio * 1.21;
    }

    public static function Alta($producto){

        $productoJson = json_encode($producto);
        $archivo = fopen("Productos.txt","a");
        fwrite($archivo,$productoJson."\n");
        fclose($archivo);
    }

    public static function Baja($producto){

        if(Producto::BuscarProducto($producto)){

            $listaProductos = Producto::ListarProductos();
            $listaSinProducto = array();
            foreach($listaProductos as $item){

                $aux = json_decode($item);
                if($producto->_nombre != $aux->_nombre){
                    
                    array_push($listaSinProducto,$item);
                }
            }
            
            $archivo = fopen("Productos.txt","w");
            foreach($listaSinProducto as $item){
                fwrite($archivo,$item);
            }
            fclose($archivo);

            $basename = pathinfo($producto->_pathFoto,PATHINFO_BASENAME);
            move_uploaded_file($producto->_pathFoto,"ElementosBorrados/".$basename);

        }
    }

    public static function BuscarProducto($producto){

        $archiv = fopen("Productos.txt","r+");
        while(!feof($archiv)){
            $prod = fgets($archiv);
            var_dump($prod);
            die();
            $aux = json_decode(fgets($archiv));
            
            if($aux->_nombre == $producto->_nombre){
                fclose($archiv);
                return true;
            }           
        }
        fclose($archivo);
        return false;
    }

    public static function ListarProductos(){

        $listaProductos = array();
        $archivo = fopen("Productos.txt","r");
        while(!feof($archivo)){

            array_push($listaProductos,fgets($archivo));
        }
        fclose($archivo);
        return $listaProductos;
    }
}


?>