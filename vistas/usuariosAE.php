<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Selección CDS | Usuarios</title>
    <script src="../js/jquery/jquery-3.3.1.js"></script>
    <script src="../js/imagen.js"></script>
</head>

<body>



    <?php
    require_once("main.php");
    include("../controladores/usuariosCtl.php");
    $controlador = new ControladorUsuarios();
    if ($_SESSION['rol'] == "A") {
        $nombre = "";
        $apellido = "";
        $dui = "";
        $cargo = "";
        $telefono = "";
        $correo = "";
        $foto = "";
        $contrasena = "";
        $add = true;
        $carpetaDestino = "../imagenes/";
        $destino = "../imagenes/user.png";

        if (isset($_GET['select'])) {
            $row = $controlador->findById(base64_decode($_GET['select']));
            $nombre = $row['Nombres'];
            $apellido = $row['Apellidos'];
            $dui = $row['Dui'];
            $cargo = $row['Cargo'];
            $telefono = $row['Telefono'];
            $correo = $row['Correo'];
            $foto = $row['Imagen'];
            $contrasena = base64_decode($row['Contrasea']);
            $add = false;
            $only = "";
        }

        echo '<div id="form" class="p-3 mb-2 text-white">
            <form method="post" enctype="multipart/form-data">
            <input type="text" value="' . $foto . '" name="archivo" style="display:none">';
        if (isset($_GET['select'])) {
            echo '<h1 >Editar Usuario</h1><br>';
            $only = "readonly";
        } else {
            echo '<h1 >Agregar Usuarios</h1><br>';
            $only = "";
        }
        echo '<div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="nombre">Nombres:</label>
                    <input type="text" name="nombre" id="nombre" class="hola" value="' . $nombre . '" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="apellido">Apellidos:</label>
                    <input type="text" name="apellido" class="hola" id="apellido" value="' . $apellido . '" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="dui">Número de DUI:</label>
                    <input type="text" name="dui" id="dui" class="hola" value="' . $dui . '" required ' . $only . '>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefono">Telefono:</label>
                    <input type="text" name="telefono" id="telefono" class="hola" value="' . $telefono . '" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="correo">Correo:</label>
                    <input type="text" name="correo" id="correo" class="hola" value="' . $correo . '" required>
    
                </div>
                <div class="col-md-6 mb-3">
                <label for="cargo">Cargo:</label></td>
                        <td><select name="cargo" id="cargo" required>
                        <option value="">Seleccionar cargo</option>';
        if ($cargo == "A") {
            echo '<option value="A" selected>Administrador</option>
                            <option value="D">Docente</option>';
        } else if ($cargo == "D") {
            echo '<option value="A">Administrador</option>
                            <option value="D" selected>Docente</option>';
        } else {
            echo '<option value="A">Administrador</option>
                            <option value="D">Docente</option>';
        }

        echo '</select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena" class="hola" value="' . $contrasena . '" required>
                </div>
                <div class="col-md-6 mb-3">
                <label for="algo">Foto:</label>
                <label for="foto" class="btn btn-outline-secondary">Selecccionar Imagen</label>
                <img src="' . $foto . '" class="user" id="algo" alt="Sin Imagen">
                <input type="file" accept=".png,.jpg,.jpeg" name="foto" id="foto" style="display:none">
                
                </div>
            </div>';
        if ($add) {
            echo '<input type="submit" value="AGREGAR" name="add" class="btn btn-success">';
        } else {
            echo '<input type="submit" value="EDITAR" name="edit" class="btn btn-success">';
        }
        echo '<a href="usuarios.php" class="btn btn-danger">CANCELAR</a>        
            </form></div>';


        if (isset($_POST['add']) || isset($_POST['edit'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $dui = $_POST['dui'];
            $cargo = $_POST['cargo'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $alt = $_POST['archivo'];

            if (isset($_FILES["foto"]) && $_FILES["foto"]["name"]) {
                if ($_FILES["foto"]["type"] == "image/jpeg" || $_FILES["foto"]["type"] == "image/jpg" || $_FILES["foto"]["type"] == "image/png") {
                    $origen = $_FILES["foto"]["tmp_name"];
                    $destino = $carpetaDestino . $_FILES["foto"]["name"];
                    move_uploaded_file($origen, $destino);
                } else {
                    echo '<script type="text/javascript">
                            alert("El archivo no es una imagen, se colocara la imagen por defecto!");
                            </script>';
                }
            } else {
                if ($alt != "") {
                    $destino = $alt;
                }
            }
            if (isset($_POST['add'])) {
                $controlador->insert($nombre, $apellido, $dui, $cargo, $telefono, $correo, $contrasena, $destino);
            } else if (isset($_POST['edit'])) {
                $controlador->edit($nombre, $apellido, $dui, $cargo, $telefono, $correo, $contrasena, $destino);
            }
        }
    } else {
        header("location: inicio.php");
    }

    ?>

    <script>
        window.onload = function() {
            var algo = document.getElementById("algo").src;
            var idxDot = algo.lastIndexOf(".") + 1;
            var extFile = algo.substr(idxDot, algo.length).toLowerCase();
            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                //$('#algo').attr('src', TmpPath);
            } else {
                $('#algo').attr('src', "../imagenes/user.png");
            }
            //$('#algo').attr('src', TmpPath);
        };
    </script>
</body>

</html>