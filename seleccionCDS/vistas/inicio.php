<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selección CDS | Resumen</title>
    <script src="../js/jquery/jquery-3.3.1.js"></script>
    <script src="../datatables/datatables.min.js"></script>
    <link rel="stylesheet" href="../datatables/datatables.min.css">
    <script src="../js/datatable.js"></script>
    <link rel="stylesheet" href="../datables/bootstrap.css">
</head>

<body>
    <?php
    require_once("main.php");
    include("../controladores/inicioCtl.php");
    include("../controladores/cursosCtl.php");
    $controlador = new Inicio();
    $ctr = new ControladorCursos();
    
    $result = $ctr->findAll();

    if (isset($_GET['curso'])) {
        if (base64_decode($_GET['curso']) != "gen") {
            $curso = base64_decode($_GET['curso']);
            $notas = $controlador->findAll2($curso);
            $_SESSION['curso2'] = $curso;
        } else {
            $notas = $controlador->findAll();
            $_SESSION['curso2'] = $curso;
        }
    } else {
        if ($_SESSION['curso2'] != "") {
            $curso = $_SESSION['curso2'];
            $notas = $controlador->findAll2($curso);
            $_SESSION['curso2'] = $curso;
        } else {
            $notas = $controlador->findAll();
        }
    }

    echo '<div id="tabla2">
    <h1>Aspirantes a Proyecto Centro de Desarrollo de Software (CDS)</h1>
    <form method="post" style="margin-top: 5px !important;pading:1px;">';
            
    if ($_SESSION['curso2'] == "gen" || $_SESSION['curso2'] == "") {
        echo '<a href="inicio.php?curso='.base64_encode("gen").'"><input type="button" value="GENERAL" name="1" style="background-color: #00d4e4;" class="btn btn-default"></a>';
    } else {
        echo '<a href="inicio.php?curso='.base64_encode("gen").'"><input type="button" value="GENERAL" name="1" class="btn btn-default"></a>';
    }
    while ($registro = $result->fetch_assoc()) {
        if ($registro['Id_Curso'] == $_SESSION['curso2']) {
            echo '<a href="inicio.php?curso=' . base64_encode($registro['Id_Curso']) . '"><input type="button" value="' . $registro['Nombre'] . '" name="1" style="background-color: #00d4e4;" class="btn btn-default"></a>';
        } else {
            echo '<a href="inicio.php?curso=' . base64_encode($registro['Id_Curso']) . '"><input type="button" value="' . $registro['Nombre'] . '" name="1"class="btn btn-default"></a>';
        }
    }

    echo '<br><br>
    <table id="vista" class="mb-2 bg-dark table table-hover table-dark table-responsive">
                <thead ><tr >
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Promedio</th>
                <th>Curso</th>
                <th>Convocatoria</th>
                <th>Estado</th>';
                if($_SESSION['rol']== "A"){
                    echo '<th>Acción</th>';
                }
                echo '</tr></thead><tfoot>
                <tr><th>Nombre</th>
                <th>Telefono</th>
                <th>Promedio</th>
                <th>Curso</th>
                <th>Convocatoria</th>';
                if($_SESSION['rol']== "A"){
                    echo '<th>Acción</th>';
                }
                echo '</tr></tfoot>';


    while ($registro = $notas->fetch_assoc()) {
        echo '<tr>
                <td>' . $registro['Nombre'] . ' ' . $registro['Apellido'] . '</td>
                <td>' . $registro['Telefono1'] . '</td>
                <td>' . $registro['Promedio'] . '</td>
                <td>' . $registro['Curso'] . '</td>
                <td>' . $registro['Convocatoria'] . '</td>
                <td>' . (($registro['Estado'] == 1) ? "Seleccionado" : "No Seleccionado") . '</td>
                <td>';
                if($_SESSION['rol']== "A"){
                    echo'<a href="notas.php?select=' . base64_encode($registro['Id_Aspirante']) . '" class="btn btn-info btn-sm">Editar Notas</a>';
                }    
                echo '</td></tr>';
    }           
    echo '</table></form></div>';

    ?>
</body>

</html>