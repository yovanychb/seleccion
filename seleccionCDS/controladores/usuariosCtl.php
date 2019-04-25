<?php
include("bitacoraCtl.php");
class ControladorUsuarios extends Bitacora
{
    function findById($id)
    {
        $id = getValue($id);
        $query = "SELECT * FROM Usuarios WHERE Dui='" . $id . "'";
        $resultSelectByID = mysqli_query($this->conexion(), $query);
        return mysqli_fetch_array($resultSelectByID);
    }

    function findAll()
    {
        $consulta = "SELECT * FROM Usuarios";
        return $this->conexion()->query($consulta);
    }

    function insert($nombre, $apellido, $dui, $cargo, $telefono, $correo, $contrasena, $destino)
    {
        $consulta = "INSERT INTO Usuarios (`Dui`, `Imagen`, `Nombres`, `Apellidos`, `Telefono`, `Cargo`, `Correo`, `Contrasea`) 
                VALUES('" . $dui . "','" . $destino . "','" . $nombre . "','" . $apellido . "','" . $telefono . "','" . $cargo . "','" . $correo . "','" . base64_encode($contrasena) . "')";

        if ($this->conexion()->query($consulta) == true) {
            $this->insertar($_SESSION['user'],"Agrego un nuevo usuario");
            echo '<script type="text/javascript">
                    alert("Registro Agregado con Exito");
                    window.location.href="usuarios.php";
                    </script>';
        } else {
            echo '<script type="text/javascript">
                    alert("Registro No Agregado ");
                    window.location.href="usuarios.php";
                    </script>';
        }
    }

    function edit($nombre, $apellido, $dui, $cargo, $telefono, $correo, $contrasena, $destino)
    {
        $consulta = "UPDATE Usuarios SET Nombres = '" . $nombre . "', Apellidos = '" . $apellido . "', Telefono = '" . $telefono . "', 
                Cargo = '" . $cargo . "', Correo = '" . $correo . "', Contrasea = '" . base64_encode($contrasena) . "', Imagen = '" . $destino . "' WHERE Dui = '" . $dui . "';";

        if ($this->conexion()->query($consulta) == true) {
            $this->insertar($_SESSION['user'],"Edito un usuario");
            echo '<script type="text/javascript">
                    alert("Registro Actualizado con Exito");
                    window.location.href="usuarios.php";
                    </script>';
        } else {
            echo '<script type="text/javascript">
                    alert("Registro No Actualizado ");
                    window.location.href="usuarios.php";
                    </script>';
        }
    }

    function delete($id)
    {

        $query = "DELETE FROM Usuarios WHERE Dui='" . $id . "';";
       
        if ($this->conexion()->query($query) == true) {
            $this->insertar($_SESSION['user'],"Elimino un usuario");
            echo '<script type="text/javascript">
                alert("Usuario eliminado con Exito");
                window.location.href="usuarios.php";
                </script>';
        }
    }
}

