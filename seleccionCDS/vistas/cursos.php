<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selección CDS | Cursos</title>
    <script src="../js/jquery/jquery-3.3.1.js"></script>
    <script src="../datatables/datatables.min.js"></script>
    <link rel="stylesheet" href="../datatables/datatables.min.css">
    <script src="../js/datatable.js"></script>

</head>

<body>
    <?php
    require_once("main.php");
    include("../controladores/cursosCtl.php");
    $cursos = new ControladorCursos();

    echo '<div>
        <form id="tabla" method="post" >
        <h1>Cursos CDS</h1>
        <a href="cursosAE.php" class="btn btn-success">Agregar Nuevo Curso</a><br><br>
        <table id="vista" class=" table table-hover table-dark table-responsive">
                <thead><tr>
                <th>Nombre</th>
                <th>Fecha de inicio</th>
                <th>Fecha de fin</th>
                <th>Catidad de convocatorias</th>
                <th>Cantidad de Aprobados</th>
                <th>Accion</th>
                </tr></thead>
                <tfoot><tr>
                <th>Nombre</th>
                <th>Fecha de inicio</th>
                <th>Fecha de fin</th>
                <th>Catidad de convocatorias</th>
                <th>Cantidad de Aprobados</th>
                <th>Accion</th>
                </tr></tfoot>';



    $result = $cursos->findAll();

    while ($registro = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $registro['Nombre'] . '</td>
                <td>' . $registro['Fecha_Inicio'] . '</td>
                <td>' . $registro['Fecha_Fin'] . '</td>
                <td>' . $registro['Cantidad_Convocatorias'] . '</td>
                <td>' . $registro['Cantidad_Aprobados'] . '</td>
                <td>
                    <a href="cursosAE.php?select=' . base64_encode($registro['Id_Curso']) . '" class="btn btn-info btn-sm">Editar</a>
                    <a data-href="cursos.php?delete=' . base64_encode($registro['Id_Curso']) . '" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger btn-sm">Eliminar</a>
            </td></tr>';
    }
    echo '</table></form></div>';


    if (isset($_GET['delete'])) {
        $cursos->delete(base64_decode($_GET['delete']));
    }


    ?>
</body>

</html>