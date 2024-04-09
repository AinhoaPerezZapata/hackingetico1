<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
//Verificar si el usuraio ha iniciado sesion
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
	//Usuario no ha iniciado sesion y lo redirigue a la pagina de inicio.
	header('Location: index.html');
	exit;
}
//Verificar si el ID de usurio está establecido en la sesión
if (isset($_SESSION['id'])){
	$id = $_SESSION['id'];
	//Ahora puedes usar $id como desses en esta página
}else{
	//El id de usuario no esta en la sesion.
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Página de inicio</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body class="loggedin" id="imagen">
		<nav class="navtop">
			<div>
				<h1>Bienvenidos!</h1>
				<?php
				if($id == 2) {
				?>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Perfil</a>
				<a href="read.php"><i class="fas fa-address-card"></i>Sesiones</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Desloguear</a>
				<?php
				} else{
					?>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Perfil</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Desloguear</a>
				<?php
				}
				?>


			</div>
		</nav>
		<div class="content">
			<h2>Página de Inicio</h2>
			<p>Bienvenido, <?=htmlspecialchars($_SESSION['name'], ENT_QUOTES)?>!</p>
		</div>
	</body>
</html>