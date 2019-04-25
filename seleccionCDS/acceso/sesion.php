<?php
    session_start();
    if ($_SESSION['estado'] != "activa"){
        header("location: login.php");
    }
?>