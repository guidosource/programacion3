<?php
require_once './model/empleados.php';
require_once './model/productos.php';

class empleadoApi{

    public function AgregarEmpleado($request,$response){
       
        $datos = $request->getParsedBody();
        $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION); //obtiene extension 
        $foto = $datos['legajo'] . '.' . $extension;
        $destino = "./img/" . $foto;
        //var_dump($destino);
        //die(); 
        
        $empleado = new Empleado();
        $empleado->nombre = $datos['nombre'];
        $empleado->apellido = $datos['apellido'];
        $empleado->email = $datos['email'];
        $empleado->legajo = $datos['legajo'];
        $empleado->clave = $datos['clave'];
        $empleado->foto = $foto;
        $empleado->perfil = $datos['perfil'];
        $empleado->Alta();
        move_uploaded_file($_FILES['foto']['tmp_name'], $destino);
        return $response->withJson("Usuario dado de alta",200);
    }

    public function todosLosEmpleados($request,$response){

        $empleados = Empleado::TraerTodos();
        $empleadosJson = json_encode($empleados);
        return $response->withJson($empleadosJson,200);

    }

    public function todosLosProductos($request,$response){
        
        $productos = Productos::TraerTodos();
        $productosJson = json_encode($productos);
        return $response->withJson($productosJson,200);

    }

    public function verificarEmpleado($request,$response){
        
        $datos = $request->getParsedBody();
        $EmpleadoEncontrado = Empleado::BuscarPorEmailClave($datos['email'],$datos['clave']);
        if(count($EmpleadoEncontrado) > 0){

            $respuesta = array("valido" => true,
            "usuario" => $datos);
            $respuestaJson = json_encode($respuesta);
            return $response->withJson($respuestaJson,200);
        }       
        else{

            $respuesta = array("valido" => false,
            "usuario" => $datos);
            $respuestaJson = json_encode($respuesta);
            return $response->withJson($respuestaJson,200);
        }

    }

    public function AgregarProducto($request,$response){

        $datos = $request->getParsedBody();
        $producto = new Productos();
        $producto->nombre = $datos['nombre'];
        $producto->precio = $datos['precio'];
        $producto->Alta();
        return $response->withJson("Producto dado de alta",200);
    }

    public function ModificarProduto($request,$response){
        $datos = $request->getParsedBody();   
        $productoEncontrado = Productos::BuscarPorId($datos['id']);
        $productoModificar = new Productos();
        $productoModificar->id = $productoEncontrado[0]->id;
        $productoModificar->nombre = $datos['nombre'];
        $productoModificar->precio = $datos['precio'];
        $productoModificar->Modificar();
        return $response->withJson("Producto modificado",200);

    }

    public function BajaProducto($request,$response){
        $datos = $request->getParsedBody();
        Productos::BajaPorId($datos['id']);
        return $response->withJson("Producto Eliminado",200);
    }
}





?>
