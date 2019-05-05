<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selección CDS | Convocatorias</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="../js/jquery/jquery-3.3.1.js"></script>
    <script src="../datatables/datatables.min.js"></script>
    <link rel="stylesheet" href="../datatables/datatables.min.css">
    <script src="../js/datatable.js"></script>
</head>

<body>
    <?php
    require_once("main.php");
    include("../controladores/convocatoriasCtl.php");
    $controlador = new ControladorConvocatorias();

    echo '<div><form id="tabla" method="post">
    <h1>Convocatorias</h1>
            <a href="convocatoriasAE.php" class="btn btn-success">AGREGAR</a><br><br>
            <table id="vista" class=" table table-hover table-dark table-responsive">
                <thead >
                <tr>
                <th>Numero</th>
                <th>Titulo</th>
                <th>Fecha de inicio</th>
                <th>Fecha de fin</th>
                <th>Cantidad de aprobados</th>
                <th>Curso</th>
                <th>Accion</th>
                </tr>
                </thead><tfoot >
                <tr>
                <th>Numero</th>
                <th>Titulo</th>
                <th>Fecha de inicio</th>
                <th>Fecha de fin</th>
                <th>Cantidad de aprobados</th>
                <th>Curso</th>
                <th>Accion</th>
                </tr>
                </tfoot>';



    $convocatorias = $controlador->findAll();

    while ($registro = $convocatorias->fetch_assoc()) {
        echo '<tr>
                    <td>' . $registro['Id_Convocatorias'] . '</td>
                    <td>' . $registro['Titulo'] . '</td>
                    <td>' . $registro['Fecha_Inicio'] . '</td>
                    <td>' . $registro['Fecha_Fin'] . '</td>
                    <td>' . $registro['Cantidad'] . '</td>
                    <td>' . $registro['Nombre'] . '</td>
                    <td>
                        <a href="convocatoriasAE.php?select=' . base64_encode($registro['Id_Convocatorias']) . '" class="btn btn-info btn-sm">Editar</a>
                        <a data-href="convocatorias.php?delete=' . base64_encode($registro['Id_Convocatorias']) . '" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm">Eliminar</a>
                </td></tr>';
    }
    echo '</table></form></div>';



    if (isset($_GET['delete'])) {
        $controlador->delete(base64_decode($_GET['delete']));
    }

    ?>
</body>

</html>