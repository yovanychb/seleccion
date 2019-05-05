<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selección CDS | Bitacora</title>
    <script src="../js/jquery/jquery-3.3.1.js"></script>
    <script src="../datatables/datatables.min.js"></script>
    <link rel="stylesheet" href="../datatables/datatables.min.css">
    <script src="../js/datatable.js"></script>
</head>

<body>
    <?php
    require_once("main.php");
    include("../controladores/aspirantesCtl.php");
    if ($_SESSION['rol'] == "A") {

        $controlador = new Bitacora();

        echo '<div ><form method="post" id="tabla">
        <h1>Bitacora del sistema</h1>
        <table id="vista" class="mb-2 bg-dark table table-hover table-dark table-responsive">
                    <thead><tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Hora</th>
                    <th>Detalles</th>
                    </tr></thead><tfoot><tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Hora</th>
                    <th>Detalles</th></tr></tfoot>';

        $bitacora = $controlador->findAll();
        while ($registro = $bitacora->fetch_assoc()) {
            echo '<tr>
                    <td>' . $registro['Nombres'] . ' </td>
                    <td>' . $registro['Apellidos'] . '</td>
                    <td>' . $registro['Hora'] . '</td>
                    <td>' . $registro['Descripcion'] . '</td>
                    </tr>';
        }
        echo '</table></form></div>';
    } else {
        header("location: inicio.php");
    }
    ?>
</body>

</html>