<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selección CDS | Cursos</title>
</head>
<body>
    <?php
    
    require_once("main.php");
    include("../controladores/cursosCtl.php");
    $cursos = new ControladorCursos();
    $id = "";
    $nombre = "";
    $inicio = "";
    $fin = "";
    $cantidad = "";
    $aprobados = "";
    $add = true;

    if (isset($_GET['select'])){
        $row = $cursos->findById(base64_decode($_GET['select']));
        $id = $row['Id_Curso'];
        $nombre = $row['Nombre'];
        $inicio = $row['Fecha_Inicio'];
        $fin = $row['Fecha_Fin'];
        $cantidad = $row['Cantidad_Convocatorias'];
        $aprobados = $row['Cantidad_Aprobados'];
        $add = false;
    } 

    echo '<div id="form" class="p-3 mb-2 text-white">
            <form method="post" >
            <h1 >Agregar Cursos</h1><br>
            <label for="id">Numero del curso: (Solo lectura)</label>
            <input type="text" name="id" id="id" value="'.$id.'" readonly > <br><br>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="'.$nombre.'"> <br><br>
            <label for="inicio">Fecha de inicio:</label>
            <input type="date" name="inicio" id="inicio" value="'.$inicio.'" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"><br><br>
            <label for="fin">Fecha de fin:</label>
            <input type="date" name="fin" id="fin" value="'.$fin.'" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"><br><br>
            <label for="cantidad">Catidad de convocatorias:</label>
            <input type="number" name="cantidad" id="cantidad" value="'.$cantidad.'"><br><br>
            <label for="aprobados">Cantidad de Aprobados:</label>
            <input type="number" name="aprobados" id="aprobados" value="'.$aprobados.'"><br><br>';
            if ($add){
                echo '<input type="submit" value="AGREGAR" name="add" class="btn btn-success">';
            } else {
            echo '<input type="submit" value="EDITAR" name="edit" class="btn btn-success">';
            }
            echo '<a href="cursos.php" class="btn btn-danger">CANCELAR</a>
       <br>            
    </form> </div>';

    if (isset($_POST['add']) || isset($_POST['edit'])) {
        $nombre = getValue($_POST['nombre']);
        $inicio = getValue($_POST['inicio']);
        $fin = getValue($_POST['fin']);
        $cantidad = getValue($_POST['cantidad']);
        $aprobados = getValue($_POST['aprobados']);
        
        if (isset($_POST['add'])) {
            $cursos->insert($nombre, $inicio, $fin, $cantidad, $aprobados, $_SESSION['user']);
        } else if (isset($_POST['edit'])){
            $id = getValue($_POST['id']);
            $cursos->edit($id, $nombre, $inicio, $fin, $cantidad, $aprobados, $_SESSION['user']);
        }
    }
    ?>
</body>
</html>