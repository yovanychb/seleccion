<?php
    session_start();
    include("../acceso/conexion.php");
    include("../controladores/bitacoraCtl.php");
    if($_SESSION['estado'] == "activa"){
        $_SESSION['estado'] == "";
        $bitacora = new Bitacora();
        $bitacora->insertar($_SESSION['user'],"Cerro sesion");
        session_destroy();
        header("location: ../vistas/login.php");
    }
    
?>