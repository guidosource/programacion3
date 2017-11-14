<?php

require_once 'AccesoDatos.php';

class Empleado{

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $legajo;
    public $clave;
    public $foto;
    public $perfil;

    // DATOS : ALTA - BAJA - MODIFICAR - LISTAR - ETC.
    
    public function Alta(){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleados (nombre,apellido,email,foto,legajo,clave,perfil)values('$this->nombre','$this->apellido','$this->email','$this->foto','$this->legajo','$this->clave','$this->perfil')");
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
                   

    }

    public function Baja(){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
            delete 
            from empleado 				
            WHERE id=:id");	
            $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
            $consulta->execute();
            return $consulta->rowCount();
    }

    public function Modificar(){

        $pass = sha1($this->clave); // encripta la clave en sha;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleado
        set nombre=:nombre,
        email=:email,
        sexo=:sexo,
        clave=:clave,
        turno=:turno,
        adm=:adm
        WHERE id=:id");
        $consulta->bindValue(':id',$this->id,PDO::PARAM_INT);
        $consulta->bindValue(':nombre',$this->nombre,PDO::PARAM_STR);
        $consulta->bindValue(':email',$this->email,PDO::PARAM_STR);
        $consulta->bindValue(':sexo',$this->sexo,PDO::PARAM_STR);
        $consulta->bindValue(':clave',$pass,PDO::PARAM_STR);
        $consulta->bindValue(':turno',$this->turno,PDO::PARAM_STR);
        $consulta->bindValue(':adm',$this->adm,PDO::PARAM_BOOL);
        return $consulta->execute();

    }

    public static function BajaPorId($id){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("
        delete 
        from empleado 				
        WHERE id=:id");	
        $consulta->bindValue(':id',$id, PDO::PARAM_INT);		
        $consulta->execute();
        return $consulta->rowCount();
    }

    public static function TraerTodos(){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT nombre,apellido,email,foto,legajo,clave,perfil FROM empleados");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Empleado");
    }

    public static function BuscarPorId($id){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id,nombre,email,sexo,clave,turno,adm FROM empleado WHERE id=:id");
        $consulta->bindValue(':id',$id,PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Empleado");

    }

    public static function BuscarPorEmailClave($email,$clave){
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT nombre,apellido,email,foto,legajo,clave,perfil FROM empleados WHERE email=:email AND clave=:clave");
        $consulta->bindValue(":email",$email,PDO::PARAM_STR);
        $consulta->bindValue(":clave",$clave,PDO::PARAM_STR);
        $consulta->execute();
        $retorno = $consulta->fetchAll(PDO::FETCH_CLASS,"Empleado");
        return $retorno;        
    }

    public static function ObtenerUltimoId(){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT MAX(id) AS id FROM empleados");
        $consulta->execute();			
        return $consulta->fetchAll();

    }

}

?>