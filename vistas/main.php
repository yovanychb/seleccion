<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Selección CDS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/navbar.css">
  <script src="../js/navbar.js"></script>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
</head>

<body>
  <?php

  include("../acceso/sesion.php");
  include("../acceso/validar.php");
  include("../acceso/conexion.php");
  include("modal.php");
  if ($_SESSION['rol'] == "A") {
    echo '<div class="navbar2" id="navbar">
    <div><img src="../imagenes/usaid.jpg" class="logo"></div>
    <a href="inicio.php" class="btn">Inicio </a>
    <a href="notas.php" class="btn">Notas</a>
    <a href="aspirantes.php" class="btn">Aspirantes</a>
    <a href="cursos.php" class="btn">Cursos</a>
    <a href="convocatorias.php" class="btn">Convocatorias</a>
    <a href="usuarios.php" class="btn">Usuarios</a>
    <a href="bitacora.php" class="btn">Bitacora</a>
    
    <a href="javascript:void(0);" class="icon" onclick="menu()">
      <i class="fa fa-bars"></i>
    </a>
    <div class="out" id="out">
    <a id="sesion"><img src="' . $_SESSION['foto'] . '" class="userid" ><label class="letra">' . $_SESSION['username'] . '</label></a>
    <a href="../acceso/salir.php" class="btn" id="logout">Cerrar Sesión</a>
    </div>
    </div>';
  } else if ($_SESSION['rol'] == "D") {
    echo '<div class="navbar2" id="navbar">
    <div><img src="../imagenes/usa.png" class="logo"></div>
    <a href="inicio.php" class="btn">Inicio </a>
    <a href="aspirantes.php" class="btn">Aspirantes</a>
    <a href="cursos.php" class="btn">Cursos</a>
    <a href="convocatorias.php" class="btn">Convocatorias</a>
    
    <a href="javascript:void(0);" class="icon" onclick="menu()">
      <i class="fa fa-bars"></i>
    </a>
    <div class="out" id="out">
    <a id="sesion"><img src="' . $_SESSION['foto'] . '" class="userid" ><label class="letra">' . $_SESSION['username'] . '</label></a>
    <a href="../acceso/salir.php" class="btn" id="logout">Cerrar Sesión</a>
    </div>  
    </div>';
  }

  ?>


</body>

</html>