<?php

    include("validar.php");
    include("../acceso/conexion.php");
    include("../controladores/usuariosCtl.php");
    $usuario = new ControladorUsuarios();
    $dui = getValue($_POST['dui']);
    $contrsea = $_POST['contrasea'];
    
    $row = $usuario->findById($dui);
    if ($row != null){
        session_start();
        $_SESSION['user'] = $row['Dui'];
        if ($row['Contrasea'] == base64_encode($contrsea)){
            $_SESSION['estado'] = "activa";
            $_SESSION['username'] = $row['Nombres'];
            $_SESSION['foto'] = $row['Imagen'];
            $_SESSION['rol'] = $row['Cargo'];
            $_SESSION['curso'] = "";
            $_SESSION['curso2'] = "";
            $usuario->insertar($dui,"Inicio sesion");
            header("location: ../index.php");
        } else {
            echo '<script type="text/javascript">
                alert("Contraseña incorrecta");
                window.location.href="../vistas/login.php";
                </script>';
        }    
    }else {
        echo '<script type="text/javascript">
            alert("Usuario invalido");
            window.location.href="../vistas/login.php";
            </script>';
    }
?>