<?php

require_once 'AccesoDatos.php';

class Empleado{

    public $id;
    public $nombre;
    public $email;
    public $sexo;
    public $clave;
    public $turno;
    public $adm;
    public $estado;

    // DATOS : ALTA - BAJA - MODIFICAR - LISTAR - ETC.
    
    public function Alta(){
        $adm = (boolean)$this->adm;
        $pass = sha1($this->clave); // encripta la clave en sha;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleado (nombre,email,sexo,clave,turno,adm,estado)values('$this->nombre','$this->email','$this->sexo','$pass','$this->turno','$adm','$this->estado')");
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
        $adm = (boolean)$this->adm;
        $pass = sha1($this->clave); // encripta la clave en sha;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleado
        set nombre=:nombre,
        email=:email,
        sexo=:sexo,
        clave=:clave,
        turno=:turno,
        adm=:adm
        estado=:estado
        WHERE id=:id");
        $consulta->bindValue(':id',$this->id,PDO::PARAM_INT);
        $consulta->bindValue(':nombre',$this->nombre,PDO::PARAM_STR);
        $consulta->bindValue(':email',$this->email,PDO::PARAM_STR);
        $consulta->bindValue(':sexo',$this->sexo,PDO::PARAM_STR);
        $consulta->bindValue(':clave',$pass,PDO::PARAM_STR);
        $consulta->bindValue(':turno',$this->turno,PDO::PARAM_STR);
        $consulta->bindValue(':adm',$adm,PDO::PARAM_BOOL);
        $consulta->bindValue(':estado',$this->estado,PDO::PARAM_STR);
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
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT id,nombre,email,sexo,turno,adm,estado FROM empleado");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Empleado");
    }

    public static function BuscarPorId($id){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id,nombre,email,sexo,clave,turno,adm,estado FROM empleado WHERE id=:id");
        $consulta->bindValue(':id',$id,PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Empleado");

    }

    public static function BuscarPorEmail($email){

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id,nombre,email,sexo,turno,adm,estado FROM empleado WHERE email=:email");
        $consulta->bindValue(":email",$email,PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS,"Empleado");
    }

    public static function BuscarPorEmailClave($email,$clave){
        
        $pass = sha1($clave); // encripta la clave en sha;
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT id,nombre,email,sexo,turno,adm,estado FROM empleado WHERE email=:email AND clave=:clave");
        $consulta->bindValue(":email",$email,PDO::PARAM_STR);
        $consulta->bindValue(":clave",$pass,PDO::PARAM_STR);
        $consulta->execute();
        $retorno = $consulta->fetchAll(PDO::FETCH_CLASS,"Empleado");
        return $retorno;        
    }



}


?>