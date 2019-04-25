<?php

class Bitacora extends Conexion
{

    function findAll()
    {
        $consulta = "SELECT t1.Nombres,t1.Apellidos,t2.Hora,t2.Usuario,t2.Descripcion FROM Bitacora t2 INNER JOIN Usuarios t1 ON(t1.Dui = t2.Usuario)";
        return $this->conexion()->query($consulta);
    }

    function insertar($usuario, $descripcion)
    {
        $consulta = "INSERT INTO Bitacora VALUES(null, (SELECT now()),'" . $usuario . "','" . $descripcion . "')";
        $this->conexion()->query($consulta);
    }

    function eliminar($id){
        $consulta = "DELETE FROM Bitacora WHERE Id_Bitacora=".$id;
        $this->conexion()->query($consulta);
    }
}
