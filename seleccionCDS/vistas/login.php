<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
	<title>Selección CDS | Iniciar Sesión</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../js/jquery/jquery-3.3.1.js"></script>
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/login.css">

</head>

<body>
	<?php
	error_reporting(0);
	session_start();
	if ($_SESSION['estado'] == "activa") {
		header("location: inicio.php");
	}

	?>

	<div class="container">
		<div class="d-flex justify-content-center h-100">
			<div class="card">
				<div class="card-header">
					<h2>Selección CDS</h2>
					<br>
					<h3>Iniciar Sesión</h3>
				</div>
				<div class="card-body">
					<form action="../acceso/ingresar.php" method="post">
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="user id" name="dui">
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" class="form-control" placeholder="contraseña" name="contrasea">
						</div>
						<div class="form-group">
							<input type="submit" value="Iniciar" class="btn float-right login_btn">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>