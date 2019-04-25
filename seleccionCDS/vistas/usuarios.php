<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selección CDS | Usuarios</title>
    <script src="../js/jquery/jquery-3.3.1.js"></script>
    <script src="../datatables/datatables.min.js"></script>
    <link rel="stylesheet" href="../datatables/datatables.min.css">
    <script src="../js/datatable.js"></script>

</head>

<body>
    <?php
    require_once("main.php");
    include("../controladores/usuariosCtl.php");
    
    $controlador = new ControladorUsuarios();
    if ($_SESSION['rol'] == "A") {
        echo '<div><form id="tabla" method="post" >
        <h1>Usuarios del sistema</h1>
        <a href="usuariosAE.php" class="btn btn-success">Agregar Nuevo Usuario</a><br><br>
        <table id="vista" class=" table table-hover table-dark table-responsive">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>DUI</th>
                <th>Cargo</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
            <th>Nombre</th>
            <th>DUI</th>
            <th>Cargo</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Acción</th>
            </tr>
            </tfoot>';

        $respuesta = $controlador->findAll();
        while ($registro =  $respuesta->fetch_assoc()) {
            echo '<tr class="algo">
                
                <td><img src="' . $registro['Imagen'] . '" class="user" id="user">' . ' ' . $registro['Nombres'] . ' ' . $registro['Apellidos'] . '</td>
                <td>' . $registro['Dui'] . '</td>
                <td>' . (($registro['Cargo'] == "A") ? "Administrador" : "Docente") . '</td>
                <td>' . $registro['Telefono'] . '</td>
                <td>' . $registro['Correo'] . '</td>
                
                <td>
                    <a href="usuariosAE.php?select=' . base64_encode($registro['Dui']) . '" class="btn btn-info btn-sm">Editar</a>
                    <a href="#" data-href="usuarios.php?delete=' . base64_encode($registro['Dui']) . '" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm">Eliminar</a>
                    
                </td></tr>';
        }
        echo '</table>  </form></div>';

        if (isset($_GET['delete'])) {
            $controlador->delete(base64_decode($_GET['delete']));
        }
    } else {
        header("location: inicio.php");
    }
    ?>
</body>

</html>