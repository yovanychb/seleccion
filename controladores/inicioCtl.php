<?php
class Inicio extends Conexion
{

    function findAll2($curso)
    {
        $consulta = "SELECT t1.Nombre, t1.Apellido,t1.Telefono1,t5.Nombre as Curso,t4.Titulo as Convocatoria,t2.Promedio,t2.Id_Aspirante,t3.Estado
            FROM Aspirantes t1 
            INNER JOIN Notas t2 ON(t1.Nit = t2.Id_Aspirante) 
            INNER JOIN Aprobados t3 ON(t1.Nit = t3.Id_Aspirante) 
            INNER JOIN Convocatorias t4 ON(t4.Id_Convocatorias = t1.NumConvocatoria)
            INNER JOIN Cursos t5 ON (t5.Id_Curso = t4.Id_Curso && t5.Id_Curso = " . $curso . ");";
        return $this->conexion()->query($consulta);
    }

    function findAll(){
        $consulta = "SELECT t1.Nombre, t1.Apellido,t1.Telefono1,t5.Nombre as Curso,t4.Titulo as Convocatoria,t2.Promedio,t2.Id_Aspirante,t3.Estado
            FROM Aspirantes t1 
            INNER JOIN Notas t2 ON(t1.Nit = t2.Id_Aspirante) 
            INNER JOIN Aprobados t3 ON(t1.Nit = t3.Id_Aspirante) 
            INNER JOIN Convocatorias t4 ON(t4.Id_Convocatorias = t1.NumConvocatoria)
            INNER JOIN Cursos t5 ON (t5.Id_Curso = t4.Id_Curso);";
        return $this->conexion()->query($consulta);
    }

}
