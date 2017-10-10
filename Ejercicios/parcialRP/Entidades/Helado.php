<?php
class Helado{

    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;

    public function Helado($sabor,$precio,$tipo,$cantidad){

        $this->sabor = $sabor;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;

    }

    public static function AltaHelado($helado){
        
        $heladoJson = json_encode($helado);
        $pFile = fopen("./Archivos/Helados.txt","a");
        fwrite($pFile,$heladoJson."\n");
        fclose($pFile);
    }

    public static function AltaVenta($email,$sabor,$tipo,$cantidad){

        $helados = Helado::TraerHelados();
        $todoOk = false;
        foreach($helados as $item){
            if($item->sabor == $sabor && $item->tipo == $tipo && $item->cantidad >= $cantidad){

                $resultados = array("email"=>$email, "sabor"=>$item->sabor, "tipo"=>$item->tipo,"precio"=>$item->precio,"cantidad"=>$cantidad);
                $pFile = fopen("./Archivos/Venta.txt","a");
                fwrite($pFile,json_encode($resultados)."\n");
                fclose($pFile);
                $item->cantidad = $item->cantidad - $cantidad;
                $todoOk = true;

            }
        }
        if($todoOk){

            $pFile = fopen("./Archivos/Helados.txt","w");
            foreach($helados as $item){
                $json = json_encode($item);
                fwrite($pFile,$json."\n");
                fclose($pFile);
                return true;
            }
        }
        else{
            echo "No se pudo realizar la venta";
            return false;
        }
        
    }

    public static function ModificarHelado($helado){
        //Trae los usuarios y modifica el usuario con valores nuevos.
        $helados = Helados::TraerHelados();
        foreach($helados as $item){
            if($helado->email == $item->email && $helado->sabor == $item->sabor){
                $item = $helado;
                break;
            }
        }
        //graba el archivo con el array de usuarios modificado.
        $pFile = fopen("./Archivos/Helados.txt","w");
        foreach($helados as $item){
            fwrite($pFile,json_encode($item)."\n");
        }
        fclose($pFile);

    }

    public static function AltaConImagen($email,$sabor,$tipo,$cantidad){


        if (Helado::AltaVenta($email,$sabor,$tipo,$cantidad)) {
            $extension = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
            $ahora = date("Ymd");
            $destino = "./Archivos/ImagenesDeLaVenta/".$sabor.$ahora.".".$extension;
            move_uploaded_file($_FILES['archivo']['tmp_name'], $destino);
        }

    }

    public static function BuscarHelado($sabor,$tipo){

        $helados = Helado::TraerHelados();
        $auxUno = false;
        $auxDos = false;
        foreach($helados as $item){

            if($item->sabor == $sabor){
                $auxUno = true;
            }
            if($item->tipo == $tipo){
                $auxDos = true;
            }

        }
        if($auxUno && $auxDos){
            echo "Si hay";
        }
        if(!$auxUno){
            echo "No existe el sabor";
        }
        if(!$auxDos){
            echo "No existe el tipo";
        }

    }
    public static function TraerVentas(){
        $ventas = array();
        $pFile = fopen("./Archivos/Venta.txt","r");
        while(!feof($pFile)){
            
            $aux = json_decode(fgets($pFile),TRUE);
            array_push($ventas,array("email"=>$aux['email'], "sabor"=>$aux['sabor'], "tipo"=>$aux['tipo'],"precio"=>$aux['precio'],"cantidad"=>$aux['cantidad']));
        }
        fclose($pFile);
        return $ventas;

    }

    public static function TraerHelados(){
        
        $helados = array();
        $pFile = fopen("./Archivos/Helados.txt","r");
        while(!feof($pFile)){
            
            $aux = json_decode(fgets($pFile),TRUE);
            array_push($helados,new Helado($aux['sabor'],$aux['precio'],$aux['tipo'],$aux['cantidad']));
        }
        fclose($pFile);
        return $helados;
    }

    public static function BuscarUsuario($email){
        
        $helados = Helado::TraerHelados();
        foreach($helados as $item){

            if($item->email == $email)
            return $item;
        }
        return NULL;
    }

    public static function ArmarGrilla($email = NULL, $sabor = NULL)
    {
        $resultados = Helado::Resultados($email, $sabor);     
        $grilla = "<table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Sabor</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Imagen</th>
            </tr>
        </thead>";
        
        if(count($resultados) > 0)
        {
            foreach($resultados as $item){
            
            $grilla .= "<tbody>
            <td>".$item['email']."</td>
            <td>".$item['sabor']."</td>
            <td>".$item['tipo']."</td>
            <td>".$item['precio']."</td>
            <td>".$item['cantidad']."</td>
            <td><img src='./Archivos/ImagenesDeLaVenta/".$item['sabor']."20171010.jpg' width='100px' height='100px'></td>
            </tbody>";
            }
            
        }
        else{
            $grilla.= "<h1>No se encontraron datos</h1>";
        }
        $grilla .= "</table>";
        echo $grilla;
        
    }
    public static function Resultados($email = NULL, $sabor = NULL)
    {
        if ($email != NULL && $sabor != NULL){
            $ventas = Helado::TraerVentas();
            $resultados = array();
            foreach ($ventas as $item) {
                if ($item['email'] == $email && $item['sabor'] == $sabor) {
                    array_push($resultados,$item);
                    
                }
            }
            if(count($resultados) != 0)
            {
                return $resultados;
            }
            else{
                echo "No se encontraron resultados";
            }
        }
        if ($email != NULL && $sabor == NULL){
            $resultados = array();
            $ventas = Helado::TraerVentas();
            foreach ($ventas as $item) {
                if ($item['email'] == $email) {
                    
                    array_push($resultados,$item);
                }
            }
            if(count($resultados) != 0)
            {
                return $resultados;
            }
            else{
                echo "No se encontraron resultados";
            }
        }
        if ($email == NULL && $sabor != NULL){
            $ventas = Helado::TraerVentas();
            $resultados = array();
            foreach ($ventas as $item) {
                if ($item['sabor']  == $sabor) {
                    
                    $resultados = array($resultados,$item);
                    return $resultados;
                }
            }
            echo "No se encontraron resultados";
        }
        if ($email == null && $titulo == null){
            $ventas = Helado::TraerVentas();
            $resultados = array();
            foreach ($ventas as $item) {
                {
                    array_push($resultados,$item);   
                }
            }
            if(count($resultados) != 0)
            {
                return $resultados;
            }
            else{
                echo "No se encontraron resultados";
            }
        }
    }

}

?>