<?php
include("bitacoraCtl.php");
class ControladorNotas extends Bitacora
{

    function findAll()
    {
        $consulta = "SELECT t1.Nombre, t1.Apellido,t2.Matematica,t2.Logica,t2.Perseverancia,t2.HabComputacionales,t2.Promedio,t2.Id_Aspirante 
        FROM Aspirantes t1 INNER JOIN Notas t2 ON(t1.Nit = t2.Id_Aspirante);";

        return $this->conexion()->query($consulta);
    }

    function findAll2($curso)
    {
        $consulta = "SELECT t1.Nombre, t1.Apellido,t2.Matematica,t2.Logica,t2.Perseverancia,t2.HabComputacionales,t2.Promedio,t2.Id_Aspirante 
        FROM Aspirantes t1 INNER JOIN Notas t2 ON(t1.Nit = t2.Id_Aspirante) INNER JOIN Convocatorias t3 ON(t3.Id_Convocatorias = t1.NumConvocatoria)
        INNER JOIN Cursos t4 ON (t4.Id_Curso = t3.Id_Curso && t4.Id_Curso = " . $curso . ");";

        return $this->conexion()->query($consulta);
    }

    function getCursos()
    {
        $consulta = "SELECT * FROM Cursos";
        return $this->conexion()->query($consulta);
    }

    function getNotasAlumno($id)
    {
        $id = getValue($id);
        $query = "SELECT * FROM Notas WHERE Id_Aspirante ='" . $id . "'";
        $resultSelectByID = mysqli_query($this->conexion(), $query);
        return mysqli_fetch_array($resultSelectByID);
    }


    function edit($id, $matematica, $logica, $perseverancia, $computacion, $promedio, $aspirante)
    {
        $consulta = "UPDATE Notas SET Matematica = '" . $matematica . "', Logica = '" . $logica . "', Perseverancia = '" . $perseverancia . "', 
                HabComputacionales = '" . $computacion . "',  Promedio = '" . $promedio . "' WHERE Id_Nota = '" . $id . "';";
        $this->conexion()->query($consulta);
        $this->insertar($_SESSION['user'],"Edito una nota");

        if ($promedio >= 3.5) {
            $consulta = "UPDATE Aprobados SET Estado = 1 WHERE Id_Aspirante='" . $aspirante . "';";
            $this->conexion()->query($consulta);
        } else {
            $consulta = "UPDATE Aprobados SET Estado = 0 WHERE Id_Aspirante='" . $aspirante . "';";
            $this->conexion()->query($consulta);
        }
        echo '<script type="text/javascript">
                alert("Notas guardadas con éxito.");
                window.location.href="notas.php";
                </script>';
    }
}
