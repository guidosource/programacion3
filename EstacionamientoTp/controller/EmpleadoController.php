<?php
require_once '../model/Estacionamiento.php';
require_once '../controller/AutentificadorJWT.php';
require_once '../model/Cochera.php';
require_once '../model/Vehiculo.php';
require_once '../model/Administracion.php';

//CLASE CON LAS FUNCIONES DEL USUARIO EMPLEADO
class EmpleadoController{

    public function NuevaOperacion($request,$response){
        //Buscamos si hay lugar disponible
        $checkLugar = Cochera::BuscarLugar();
        if(count($checkLugar)>0){
            //Busca el vehiculo
            $Vehiculo = Vehiculo::BuscarPorId($request->getParsedBody()['idVehiculo']);
            if(count($Vehiculo)){
                if($Vehiculo[0]->prioridad == 0){
                    $idCochera = Cochera::BuscarSimple();            
                }
                else{
                    $idCochera = Cochera::BuscarPrioritaria();
                    if(count($idCochera)==0){
                        $idCochera = Cochera::BuscarSimple();
                    }
                }
                if(count($idCochera > 0)){
                    //Obtenemos los datos del empleado.
                    $token = $request->getHeader('token');
                    $datosEmpleado = AutentificadorJWT::ObtenerData($token[0]);
                    //Cargamos los datos.
                    $idEmpleadoIngreso = $datosEmpleado->id;
                    $fechaIngreso = date("Y-m-d H:i:s");
                    $operacion = new Estacionamiento();
                    $operacion->idEmpleadoIngreso = $idEmpleadoIngreso;
                    $operacion->fechaIngreso = $fechaIngreso;
                    $operacion->idCochera = $idCochera[0];
                    $operacion->idVehiculo = $Vehiculo[0];
                    $operacion->estado = EstacionamientoEstados::encurso;
                    $operacion->Alta();
                    // Se inserta en la bd la nueva operacion.
                    try{
                        $operacion->Alta();
                        $response->write('Nuevo ingreso registrado');
                        $response->withStatus(200);
                        return $response;
                    }
                    catch(Exception $ex){
                        $respuesta = new stdclass();
                        $respuesta->error = $ex->getMessage();
                        return $response->withJson($respuesta,500);    
                    }
                }
                else{
                    $respuesta = new stdclass();
                    $respuesta->error = "Solo hay lugares con prioridad ";
                    return $response->withJson($respuesta,500);
                }
            }
            else{
                $respuesta = new stdclass();
                $respuesta->error = "No hay datos del vehiculo ";
                return $response->withJson($respuesta,500);
            }
        }
        else{
            $respuesta = new stdclass();
            $respuesta->error = "No hay lugar disponible ";
            return $response->withJson($respuesta,500);
        }    
    }

    public function FinalizarOperacion($request,$response){
        $operacion = Estacionamiento::BuscarPorId($request->getParsedBody()['id']);
        if(count($operacion) > 0 ) {
            $datosEmpleado = AutentificadorJWT::ObtenerData($token[0]);
            $fechaSalida = date("Y-m-d H:i:s");
            $importe = CalcularImporte($fechaIngreso,$fechaSalida);
            $update = new Estacionamiento();

        }
        else{
            $respuesta = new stdclass();
            $respuesta->error = "No hay datos de la operacion ";
            return $response->withJson($respuesta,500);
        }
    }

    private function CalcularTarifa($fechaIngreso,$fechaSalida){
        $tiempo = $fechaIngreso - $fechaSalida;
        

    }
    //FUNCIONES VEHICULOS
    
    public function altaVehiculo($request,$response){

        $files = $request->getUploadedFiles();
        $foto = $files['foto'];
        $nombre = $foto->getClientFilename();
        $tipo = $foto->getClientMediaType();
        $foto->moveTo("http://localhost/workspace/programacion3/EstacionamientoTp/assets/images/$nombre");
        
        return $response;
        
        $vehiculo = new Vehiculo();
        $vehiculo->patente = $request->getParsedBody()["patente"];
        $vehiculo->color = $request->getParsedBody()["color"];
        $vehiculo->marca = $request->getParsedBody()["marca"];
        $vehiculo->estacionado = 0;
        

        //$vehiculo->foto = $request->getParsedBody()["foto"];

    }
    //FUNCIONES OPERATIVAS

    public function traerVehiculosEstacionados($request,$response){

        $estacionados = Vehiculo::traerEstacionados();
        return $response->withJson($estacionados,200);

    }

    
    public function ActualizarEmpleado($request,$response){
        
        $empleado = new Empleado();
        $empleado->id = $request->getParsedBody()["id"];
        $empleado->nombre = $request->getParsedBody()["nombre"];
        $empleado->email = $request->getParsedBody()["email"];
        $empleado->sexo = $request->getParsedBody()["sexo"];
        $empleado->clave = $request->getParsedBody()["clave"];
        $empleado->turno = $request->getParsedBody()["turno"];
        $empleado->adm = $request->getParsedBody()["adm"];
        $empleado->estado = $request->getParsedBody()["estado"];
        $empleado->Modificar();
        $response->write('Empleado actualizado');
        $response->withStatus(200);
        return $response;
    }

    public function EliminarEmpleado($request,$response){

        Empleado::BajaPorId($request->getParsedBody()["id"]);
        $response->write('Empleado eliminado');
        $response->withStatus(200);
        return $response;
    }

    public function TodosLosEmpleados($request,$response){

        $empleados = Empleado::TraerTodos();
        $response->withStatus(200);
        return $response->withJson($empleados,200);
    }

    public function SaludoEmpleado($request,$response){
        echo 'soy empleado';
        return $response;
    }

}


?>