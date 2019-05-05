<?php
include("bitacoraCtl.php");
class ControladorConvocatorias extends Bitacora
{
    function findAll()
    {
        $consulta = "SELECT t1.Id_Convocatorias,t1.Titulo,t1.Fecha_Inicio,t1.Fecha_Fin,t1.Cantidad,t1.Id_Curso,t2.Nombre 
            FROM Cursos t2 INNER JOIN Convocatorias t1 ON (t1.Id_Curso=t2.Id_Curso)";
        return $this->conexion()->query($consulta);
    }

    function findAllCursos(){
        $consulta = "SELECT * FROM Cursos";
        return $this->conexion()->query($consulta);
    }

    function findById($id)
    {
        $id = getValue($id);
        $query = "SELECT t1.Id_Convocatorias,t1.Titulo,t1.Fecha_Inicio,t1.Fecha_Fin,t1.Cantidad,t1.Id_Curso,t2.Nombre 
            FROM Cursos t2 INNER JOIN Convocatorias t1 ON (t1.Id_Curso=t2.Id_Curso AND Id_Convocatorias=" . $id . ")";
        $resultSelectByID = mysqli_query($this->conexion(), $query);
        return mysqli_fetch_array($resultSelectByID);
    }

    function insert($id, $titulo, $inicio, $fin, $cantidad, $curso)
    {
        $consulta = "INSERT INTO Convocatorias (`Id_Convocatorias`,`Titulo`, `Fecha_Inicio`, `Fecha_Fin`, `Cantidad` , `Id_Curso`) 
                VALUES('".$id."','".$titulo."','".$inicio."','".$fin."','".$cantidad."','".$curso."')";
        if ($this->conexion()->query($consulta) == true) {
            $this->insertar($_SESSION['user'],"Agrego una nueva Convocatoia");
            echo '<script> 
            alert("agregado con exito");
            window.location.href="convocatorias.php";
            </script>';
        }
    }

    function edit($id, $titulo, $inicio, $fin, $cantidad, $curso)
    {
        $consulta = "UPDATE Convocatorias SET Titulo = '".$titulo."', Fecha_Inicio = '".$inicio."', 
                Fecha_Fin = '".$fin."', Cantidad = '".$cantidad."', Id_Curso = '".$curso."' WHERE Id_Convocatorias = ".$id.";";
        if ($this->conexion()->query($consulta)) {
            $this->insertar($_SESSION['user'],"Edito una Convocatoia");
            echo '<script> 
            alert("Editado con exito");
            window.location.href="convocatorias.php";
            </script>';
        }
    }

    function delete($id)
    {
        $id = getValue($id);
        $query = "DELETE FROM Convocatorias WHERE Id_Convocatorias='".$id."'";
        $result = $this->conexion()->query($query);
        $this->insertar($_SESSION['user'],"Elimino una Convocatoia");
        echo '<script type="text/javascript">
            alert("Usuario eliminado con Exito");
            window.location.href="convocatorias.php";
            </script>';
    }
}
