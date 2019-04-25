<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selección CDS | Aspirantes</title>
</head>

<body>
    <?php
    require_once("main.php");
    include("../controladores/aspirantesCtl.php");
    $controlador = new ControladorAspirantes();
    $nit = "";
    $nombre = "";
    $apellido = "";
    $dui = "";
    $nacimiento = "";
    $correo = "";
    $direccion = "";
    $facebook = "";
    $tel1 = "";
    $tel2 = "";
    $telfijo = "";
    $nivel = "";
    $numero = "";
    $add = true;

    if (isset($_GET['select'])) {
        $row = $controlador->findById(base64_decode($_GET['select']));
        $nit = $row['Nit'];
        $nombre = $row['Nombre'];
        $apellido = $row['Apellido'];
        $dui = $row['Dui'];
        $correo = $row['Correo'];
        $direccion = $row['Direccion'];
        $facebook = $row['Facebook'];
        $tel1 = $row['Telefono1'];
        $tel2 = $row['Telefono2'];
        $telfijo = $row['TelefonoFijo'];
        $nivel = $row['NivelAcademico'];
        $numero = $row['NumConvocatoria'];
        $add = false;
    }

    echo '<div id="form" class="p-3 mb-2 text-white">
            <form method="post" >
            <div class="form-row">
                <div class="col-md-6 mb-3">
                <label for="nit">NIT:</label>
                <input type="text" name="nit" id="nit" value="' . $nit . '" required>
                </div>
                <div class="col-md-6 mb-3">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="' . $nombre . '" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" value="' . $apellido . '" required>
                </div>
                <div class="col-md-6 mb-3">
                <label for="dui">DUI</label>
                <input type="text" name="dui" id="dui" value="' . $dui . '">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                <label for="nacimiento">Fecha de Nacimiento</label>
                <input type="date" name="nacimiento" id="nacimiento" value="' . $nacimiento . ' pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required>
                </div>
                <div class="col-md-6 mb-3">
                <label for="correo">Correo</label>
                <input type="text" name="correo" id="correo" value="' . $correo . '" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" id="direccion" value="' . $direccion . '" required>
                </div>
                <div class="col-md-6 mb-3">
                <label for="facebook">Facebook</label>
                <input type="text" name="facebook" id="facebook" value="' . $facebook . '" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                <label for="tel1">Telefono1</label>
                <input type="text" name="tel1" id="tel1" value="' . $tel1 . '" required>
                </div>
                <div class="col-md-4 mb-3">
                <label for="tel2">Telefono2</label>
                <input type="text" name="tel2" id="tel2" value="' . $tel2 . '">
                </div>
                <div class="col-md-4 mb-3">
                <label for="telfijo">Telefono Fijo</label>
                <input type="text" name="telfijo" id="telfijo" value="' . $telfijo . '">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                <label for="nivel">Nivel Academico</label>
                <input type="text" name="nivel" id="nivel" value="' . $nivel . '" required>
                </div>
                <div class="col-md-6 mb-3">
                <label for="numero">Convocatoria</label>
                <select name="numero" id="numero"  required>
                <option value="">Seleccione una convocatoria</option>';

    $convocatorias = $controlador->findAllConvocatorias();
    while ($registro = $convocatorias->fetch_assoc()) {
        if ($registro['Id_Convocatorias'] == $numero) {
            echo '<option value="' . $registro['Id_Convocatorias'] . '" selected>' . $registro['Titulo'] . '</option>';
        } else {
            echo '<option value="' . $registro['Id_Convocatorias'] . '">' . $registro['Titulo'] . '</option>';
        }
    }
    echo '</select></div>
    </div><br><br>';

    if ($add) {
        echo '<input type="submit" value="AGREGAR" name="add" class="btn btn-success">';
    } else {
        echo '<input type="submit" value="EDITAR" name="edit" class="btn btn-success">';
    }
    echo '<a href="aspirantes.php" class="btn btn-danger">CANCELAR</a>
                <br>            
            </form></div>';

    if (isset($_POST['add']) || isset($_POST['edit'])) {
        $nit = getValue($_POST['nit']);
        $nombre = getValue($_POST['nombre']);
        $apellido = getValue($_POST['apellido']);
        $dui = getValue($_POST['dui']);
        $nacimiento = getValue($_POST['Fecha_Nacimiento']);
        $correo = getValue($_POST['correo']);
        $direccion = getValue($_POST['direccion']);
        $facebook = getValue($_POST['facebook']);
        $tel1 = getValue($_POST['tel1']);
        $tel2 = getValue($_POST['tel2']);
        $telfijo = getValue($_POST['telfijo']);
        $nivel = getValue($_POST['nivel']);
        $numero = getValue($_POST['numero']);


        if (isset($_POST['add'])) {
            $controlador->insert($nit, $nombre, $apellido, $dui, $nacimiento, $correo, $direccion, $facebook, $tel1, $tel2, $telfijo, $nivel, $numero);
        } else if (isset($_POST['edit'])) {
            $controlador->edit($nit, $nombre, $apellido, $dui, $nacimiento, $correo, $direccion, $facebook, $tel1, $tel2, $telfijo, $nivel, $numero);
        }
    }


    ?>
</body>

</html>