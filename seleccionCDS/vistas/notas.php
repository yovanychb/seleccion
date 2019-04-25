<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selección CDS | Notas</title>
    <script src="../js/jquery/jquery-3.3.1.js"></script>
    <script src="../datatables/datatables.min.js"></script>
    <link rel="stylesheet" href="../datatables/datatables.min.css">
    <script src="../js/datatable.js"></script>


</head>

<body>

    <?php
    require_once("main.php");
    include("../controladores/notasCtl.php");
    $controlador = new ControladorNotas();
    if ($_SESSION['rol'] == "A") {

        $id = "";
        $matematica = "";
        $logica = "";
        $perseverancia = "";
        $computacion = "";
        $promedio = "";
        $aspirante = "";
        $edit = true;
        $curso = "";
        $algo = "";

        if (isset($_GET['select'])) {
            $row = $controlador->getNotasAlumno(base64_decode($_GET['select']));
            $id = $row['Id_Nota'];
            $matematica = $row['Matematica'];
            $logica = $row['Logica'];
            $perseverancia = $row['Perseverancia'];
            $computacion = $row['HabComputacionales'];
            $promedio = $row['Promedio'];
            $aspirante = $row['Id_Aspirante'];
            $edit = false;
            $algo = true;
        }

        if (isset($_GET['curso'])) {
            if (base64_decode($_GET['curso']) != "gen") {
                $curso = base64_decode($_GET['curso']);
                $notas = $controlador->findAll2($curso);
                $_SESSION['curso'] = $curso;
            } else {
                $notas = $controlador->findAll();
                $_SESSION['curso'] = $curso;
            }
        } else {
            if ($_SESSION['curso'] != "") {
                $curso = $_SESSION['curso'];
                $notas = $controlador->findAll2($curso);
                $_SESSION['curso'] = $curso;
            } else {
                $notas = $controlador->findAll();
            }
        }

        echo '<div ><form method="post" id="tabla">
            <h1>Cuadro de notas por Aspirante</h1>';
        if ($_SESSION['curso'] == "gen" || $_SESSION['curso'] == "") {
            echo '<a href="notas.php?curso=' . base64_encode("gen") . '"><input type="button" value="GENERAL" name="1" style="background-color: #00d4e4;" class="btn btn-default"></a>';
        } else {
            echo '<a href="notas.php?curso=' . base64_encode("gen") . '"><input type="button" value="GENERAL" name="1" class="btn btn-default"></a>';
        }
        $cursos = $controlador->getCursos();
        while ($registro = $cursos->fetch_assoc()) {
            if ($registro['Id_Curso'] == $_SESSION['curso']) {
                echo '<a href="notas.php?curso=' . base64_encode($registro['Id_Curso']) . '"><input type="button" value="' . $registro['Nombre'] . '" name="1" style="background-color: #00d4e4;" class="btn btn-default"></a>';
            } else {
                echo '<a href="notas.php?curso=' . base64_encode($registro['Id_Curso']) . '"><input type="button" value="' . $registro['Nombre'] . '" name="1" class="btn btn-default"></a>';
            }
        }

        echo '<br><br>
            <table id="vista" class=" table table-hover table-dark table-responsive">
                <thead><tr>
                <th>Nombre</th>
                <th>Matematica</th>
                <th>Logica</th>
                <th>Perseverancia</th>
                <th>Habilidades Computacionales</th>
                <th>Promedio</th>
                <th>Acción</th>
                </tr></thead>
                <tfoot><tr>
                <th>Nombre</th>
                <th>Matematica</th>
                <th>Logica</th>
                <th>Perseverancia</th>
                <th>Habilidades Computacionales</th>
                <th>Promedio</th>
                <th>Acción</th>
                </tr></tfoot>';



        while ($registro = $notas->fetch_assoc()) {
            echo '<tr>
                <td>' . $registro['Nombre'] . ' ' . $registro['Apellido'] . '</td>';
            if ($registro['Id_Aspirante'] != $aspirante) {
                echo '<td>' . $registro['Matematica'] . '</td>
                    <td>' . $registro['Logica'] . '</td>
                    <td>' . $registro['Perseverancia'] . '</td>
                    <td>' . $registro['HabComputacionales'] . '</td>
                    <td>' . $registro['Promedio'] . '</td>';
                if (isset($_GET['curso'])) {
                    $curso = base64_decode($_GET['curso']);
                    echo '<td><a href="http://localhost/seleccioncds/vistas/notas.php?curso=' . $_GET['curso'] . '&&select=' . base64_encode($registro['Id_Aspirante']) . '" class="btn btn-info btn-sm">Editar</a> </td></tr>';
                } else {
                    echo '<td><a href="http://localhost/seleccioncds/vistas/notas.php?select=' . base64_encode($registro['Id_Aspirante']) . '" class="btn btn-info btn-sm">Editar</a> </td></tr>';
                }
            } else {
                echo '<td><input type="text" name="mat" value="' . $registro['Matematica'] . '"></td>
                    <td><input type="text" name="log" value="' . $registro['Logica'] . '"></td>
                    <td><input type="text" name="per" value="' . $registro['Perseverancia'] . '"></td>
                    <td><input type="text" name="comp" value="' . $registro['HabComputacionales'] . '"></td>
                    <td>' . $registro['Promedio'] . '</td>
                        <td><input type="submit" value="Guardar" name="edit" class="btn btn-success btn-sm"></td></tr>';
            }
        }
        echo '</table></form></div>';

        if (isset($_POST['edit'])) {
            $matematica = getValue($_POST['mat']);
            $logica = getValue($_POST['log']);
            $perseverancia = getValue($_POST['per']);
            $computacion = getValue($_POST['comp']);
            $promedio = ($matematica + $logica + $perseverancia + $computacion) / 4;

            $controlador->edit($id, $matematica, $logica, $perseverancia, $computacion, $promedio, $aspirante);
        }
    } else {
        header("location: inicio.php");
    }
    ?>
</body>

</html>