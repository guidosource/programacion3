<?php
require_once '../model/Empleado.php';

//simil enum
abstract class Estados{
    
    const ACTIVO = 'Activo';
    const SUSPENDIDO = 'Suspendido';
    const BAJA = 'Baja';

}


class EmpleadoController{

    public function NuevoEmpleado($request,$response,$args){
        if(count(Empleado::BuscarPorEmail($request->getParsedBody()["email"])) == 0){

            $empleado = new Empleado();
            $empleado->nombre = $request->getParsedBody()["nombre"];
            $empleado->email = $request->getParsedBody()["email"];
            $empleado->sexo = $request->getParsedBody()["sexo"];
            $empleado->clave = $request->getParsedBody()["clave"];
            $empleado->turno = $request->getParsedBody()["turno"];
            $empleado->adm = $request->getParsedBody()["adm"];
            $empleado->estado = Estados::ACTIVO;
            $empleado->Alta();
            $response->write('Nuevo empleado dado de alta');
            $response->withStatus(200);
            return $response;
        }
        else{
            $response->write('El email ya existe');
            $response->withStatus(500);
            return $response;
        }
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

}


?>