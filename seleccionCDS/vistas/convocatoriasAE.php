<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selección CDS | Convocatorias</title>
</head>

<body>
    <?php
    require_once("main.php");
    include("../controladores/convocatoriasCtl.php");
    $controlador = new ControladorConvocatorias();
    $id = "";
    $titulo = "";
    $inicio = "";
    $fin = "";
    $cantidad = "";
    $curso = "";
    $cursoID = "";
    $add = true;

    if (isset($_GET['select'])) {
        $row = $controlador->findById(base64_decode($_GET['select']));
        $id = $row['Id_Convocatorias'];
        $titulo = $row['Titulo'];
        $inicio = $row['Fecha_Inicio'];
        $fin = $row['Fecha_Fin'];
        $cantidad = $row['Cantidad'];
        $curso = $row['Nombre'];
        $cursoID = $row['Id_Curso'];
        $add = false;
    }


    $cursos = $controlador->findAllCursos();


    echo '<div id="form" class="p-3 mb-2 text-white">
    <form method="post" >
        <h1 >Agregar Convocatorias</h1><br>    
        <label for="curso">Curso:  </label>
            <select name="curso" id="curso">
            <option value="">Seleccione un curso</option>';
    while ($registro = $cursos->fetch_assoc()) {
        if ($registro['Id_Curso'] == $cursoID) {
            echo '<option value="' . $registro['Id_Curso'] . '" selected>' . $registro['Nombre'] . '</option>';
        } else {
            echo '<option value="' . $registro['Id_Curso'] . '">' . $registro['Nombre'] . '</option>';
        }
    }

    echo '</select><br><br>
                <label for="nombre">Numero:</label>
                <input type="text" name="id" id="id" value="' . $id . '" > <br><br>
                <label for="nombre">Titulo:</label>
                <input type="text" name="titulo" id="titulo" value="' . $titulo . '"> <br><br>
                <label for="nombre">Fecha de inicio:</label>
                <input type="date" name="inicio" id="inicio" value="' . $inicio . '" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"><br><br>
                <label for="nombre">Fecha de fin:</label>
                <input type="date" name="fin" id="fin" value="' . $fin . '" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"><br><br>
                <label for="nombre">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" value="' . $cantidad . '"><br><br>';
    if ($add) {
        echo '<input type="submit" value="AGREGAR" name="add" class="btn btn-success">';
    } else {
        echo '<input type="submit" value="EDITAR" name="edit" class="btn btn-success">';
    }
    echo '<a href="convocatorias.php" class="btn btn-danger">CANCELAR</a>
                <br>            
            </form></div>';

    if (isset($_POST['add']) || isset($_POST['edit'])) {
        $id = getValue($_POST['id']);
        $titulo = getValue($_POST['titulo']);
        $inicio = getValue($_POST['inicio']);
        $fin = getValue($_POST['fin']);
        $cantidad = getValue($_POST['cantidad']);
        $curso = getValue($_POST['curso']);

        if (isset($_POST['add'])) {
            $controlador->insert($id, $titulo, $inicio, $fin, $cantidad, $curso);
        } else if (isset($_POST['edit'])) {
            $controlador->edit($id, $titulo, $inicio, $fin, $cantidad, $curso);
        }
    }

    ?>
</body>

</html>