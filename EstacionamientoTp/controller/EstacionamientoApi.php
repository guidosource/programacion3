<?php
require_once '../model/Estacionamiento.php';
//require_once '../model/Vehiculo.php';
//require_once '../model/Vehiculo.php';
//require_once '../model/Vehiculo.php';


class EstacionamientoApi{

    public function TraerTodos($request, $response, $args) {
        $todosLosRegistros=Estacionamiento::TraerTodosLosRegistros();
       
        $newResponse = $response->withJson($todosLosRegistros, 200);  
      return $newResponse;
  }

  
}



?>