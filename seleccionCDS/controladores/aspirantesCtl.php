<?php
include("bitacoraCtl.php");
class ControladorAspirantes extends Bitacora
{

    function findAll()
    {
        $consulta = "SELECT * FROM Aspirantes";
        return $this->conexion()->query($consulta);
    }

    function findAllConvocatorias()
    {
        $consulta = "SELECT * FROM Convocatorias";
        return $this->conexion()->query($consulta);
    }

    function findById($id)
    {
        $id = getValue($id);
        $query = "SELECT * FROM Aspirantes WHERE Nit='" . $id . "'";
        $resultSelectByID = mysqli_query($this->conexion(), $query);
        return mysqli_fetch_array($resultSelectByID);
    }

    function insert($nit, $nombre, $apellido, $dui, $nacimiento, $correo, $direccion, $facebook, $tel1, $tel2, $telfijo, $nivel, $numero)
    {
        $consulta = "INSERT INTO Aspirantes (`Nit`, `Nombre`, `Apellido`, `Dui`, `Fecha_Nacimiento`,`Correo`, `Direccion`, `Facebook`, `Telefono1`, `Telefono2`, `TelefonoFijo`, `NivelAcademico`, `NumConvocatoria`) 
                VALUES ('" . $nit . "', '" . $nombre . "', '" . $apellido . "', '" . $dui . "', '" . $nacimiento . "', '" . $correo . "', '" . $direccion . "', '" . $facebook . "', '" . $tel1 . "', '" . $tel2 . "', '" . $telfijo . "', '" . $nivel . "', '" . $numero . "');";
        $consulta2 = "INSERT INTO Notas (`Matematica`, `Logica`, `Perseverancia`, `HabComputacionales`, `Promedio`, `Id_Aspirante`) 
                VALUES (0, 0, 0, 0, 0, '" . $nit . "');";
        $consulta3 = "INSERT INTO Aprobados (`Estado`, `Id_Aspirante`) VALUES (0, '" . $nit . "');";
        try {
            $result = $this->conexion()->query($consulta);
            $result2 = $this->conexion()->query($consulta2);
            $result3 = $this->conexion()->query($consulta3);
            $this->insertar($_SESSION['user'],"Agrego un nuevo aspirante");
            echo '<script> 
                        alert("agregado con exito");
                        window.location.href="aspirantes.php";
                        </script>';
            
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }

    function edit($nit, $nombre, $apellido, $dui, $nacimiento, $correo, $direccion, $facebook, $tel1, $tel2, $telfijo, $nivel, $numero)
    {
        $consulta = "UPDATE Aspirantes SET Nombre = '" . $nombre . "', Apellido = '" . $apellido . "', 
                Dui = '" . $dui . "',Fecha_Nacimiento = '" . $nacimiento . "', Correo = '" . $correo . "', Direccion = '" . $direccion . "', Facebook = '" . $facebook . "', 
                Telefono1 = '" . $tel1 . "', Telefono2 = '" . $tel2 . "', TelefonoFijo = '" . $telfijo . "', 
                NivelAcademico = '" . $nivel . "', NumConvocatoria = '" . $numero . "' WHERE Nit = '" . $nit . "'";

        $result = $this->conexion()->query($consulta);
        $this->insertar($_SESSION['user'],"Edito un aspirante");
        echo '<script> 
                alert("Editado con exito");
                window.location.href="aspirantes.php";
                </script>';
    }

    function delete($id)
    {
        $id = getValue($id);
        $query = "DELETE FROM Aspirantes WHERE Nit ='" . $id . "'";
        $query2 = "DELETE FROM Notas WHERE Id_Aspirante ='" . $id . "'";
        $query3 = "DELETE FROM Aprobados WHERE Id_Aspirante ='" . $id . "'";
        $result2 = $this->conexion()->query($query2);
        $result3 = $this->conexion()->query($query3);
        $result = $this->conexion()->query($query);
        $this->insertar($_SESSION['user'],"Elimino un aspirante");
        echo '<script type="text/javascript">
                alert("Usuario eliminado con Exito");
                window.location.href="aspirantes.php";
                </script>';
    }
}
