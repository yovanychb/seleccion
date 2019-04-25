<?php
include("bitacoraCtl.php");
class ControladorCursos extends Bitacora
{

    function findAll()
    {
        $consulta = "SELECT * FROM Cursos";
        return $this->conexion()->query($consulta);
    }

    function findById($id)
    {
        $id = getValue($id);
        $query = "SELECT * FROM Cursos WHERE Id_Curso='" . $id . "'";
        $resultSelectByID = mysqli_query($this->conexion(), $query);
        return mysqli_fetch_array($resultSelectByID);
    }

    function insert($nombre, $inicio, $fin, $cantidad, $aprobados, $usuario)
    {
        $consulta = "INSERT INTO Cursos (`Nombre`, `Fecha_Inicio`, `Fecha_Fin`, `Cantidad_Convocatorias`, `Cantidad_Aprobados`, `Id_Usuario`) 
            VALUES('" . $nombre . "','" . $inicio . "','" . $fin . "','" . $cantidad . "','" . $aprobados . "','" . $usuario . "')";
        if ($this->conexion()->query($consulta) == true) {
            $this->insertar($_SESSION['user'],"Agrego un nuevo Curso");
            echo '<script> 
            alert("agregado con exito");
            window.location.href="cursos.php";
            </script>';
        }
    }

    function edit($id, $nombre, $inicio, $fin, $cantidad, $aprobados, $usuario)
    {
        $consulta = "UPDATE Cursos SET Nombre = '" . $nombre . "', Fecha_Inicio = '" . $inicio . "', Fecha_Fin = '" . $fin . "', 
            Cantidad_Convocatorias = '" . $cantidad . "', Cantidad_Aprobados = '" . $aprobados . "', Id_Usuario = '" . $usuario . "' WHERE Id_Curso = " . $id . ";";
        if ($this->conexion()->query($consulta)) {
            $this->insertar($_SESSION['user'],"Edito un Curso");
            echo '<script> 
            alert("Editado con exito");
            window.location.href="cursos.php";
            </script>';
        }
    }

    function delete($id)
    {
        $id = getValue($id);
        $query = "DELETE FROM Cursos WHERE Id_Curso=" . $id . "";
        $result = $this->conexion()->query($query);
        $this->insertar($_SESSION['user'],"Elimino un Curso");
        echo '<script type="text/javascript">
            alert("Usuario eliminado con Exito");
            window.location.href="cursos.php";
            </script>';
    }
}
