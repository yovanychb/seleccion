<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selección CDS | Aspirantes</title>
    <script src="../js/jquery/jquery-3.3.1.js"></script>
    <script src="../datatables/datatables.min.js"></script>
    <link rel="stylesheet" href="../datatables/datatables.min.css">
    <script src="../js/datatable.js"></script>
</head>

<body>
    <?php
    require_once("main.php");
    include("../controladores/aspirantesCtl.php");
    $controlador = new ControladorAspirantes();

    echo '<div><form id="tabla" method="post" style="width:90%; max-width:95%;">
    <h1>Aspirantes a CDS</h1>
    <a href="aspirantesAE.php" class="btn btn-success btn-lg">AGREGAR</a>
    <table id="vista" class=" table table-hover table-dark table-responsive">
        <thead><tr>
        <th>Nit</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Dui</th>
        <th>Fecha de Nacimiento</th>
        <th>Correo</th>
        <th>Dirección</th>
        <th>Facebook</th>
        <th>Telefono1</th>
        <th>Telefono Fijo</th>
        <th>Nivel Academico</th>
        <th>Numero Convocatoria</th>
        <th>Accion</th>
        <br></tr>
        </thead>
        <tfoot><tr>
        <th>Nit</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Dui</th>
        <th>Fecha de Nacimiento</th>
        <th>Correo</th>
        <th>Dirección</th>
        <th>Facebook</th>
        <th>Telefono1</th>
        <th>Telefono Fijo</th>
        <th>Nivel Academico</th>
        <th>Numero Convocatoria</th>
        <th>Accion</th>
        <br></tr>
        </tfoot>';

    $aspirantes = $controlador->findAll();

    while ($registro = $aspirantes->fetch_assoc()) {
        echo '<tr>
                    <td>' . $registro['Nit'] . '</td>
                    <td>' . $registro['Nombre'] . '</td>
                    <td>' . $registro['Apellido'] . '</td>
                    <td>' . $registro['Dui'] . '</td>
                    <td>' . $registro['Fecha_Nacimiento'] . '</td>
                    <td>' . $registro['Correo'] . '</td>
                    <td>' . $registro['Direccion'] . '</td>
                    <td>' . $registro['Facebook'] . '</td>
                    <td>' . $registro['Telefono1'] . '</td>
                    <td>' . $registro['TelefonoFijo'] . '</td>
                    <td>' . $registro['NivelAcademico'] . '</td>
                    <td>' . $registro['NumConvocatoria'] . '</td>
                    <td>
                        <a href="aspirantesAE.php?select=' . base64_encode($registro['Nit']) . '" class="btn btn-info btn-sm">Editar</a>
                        <a data-href="aspirantes.php?delete=' . base64_encode($registro['Nit']) . '" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm">Eliminar</a>
                </td></tr>';
    }
    echo '</table></form></div>';

    if (isset($_GET['delete'])) {
        $controlador->delete(base64_decode($_GET['delete']));
    }


    ?>
    </form>
</body>

</html>