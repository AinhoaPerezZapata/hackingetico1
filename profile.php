<?php
session_start();
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

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Perfil</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
			<?php
				if($id ==2) {
				?>
				<a href="home.php"><i class="fa-solid fa-house"></i>Inicio</a>
				<a href="read.php"><i class="fas fa-address-book"></i>Usuarios</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Desloguear</a>

				<?php
				}else{
					?>
				<a href="home.php"><i class="fa-solid fa-house"></i>Inicio</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Desloguear</a>
				
				<?php
				}
				?>
			</div>
		</nav>
		<div class="content">
			<h2></i>Perfil</h2>
			<div>
				<p>Detalles de la cuenta:</p>
				<table>
					<tr>
						<td>Nombre de usuario:</td>
						<td><?=htmlspecialchars($_SESSION['name'], ENT_QUOTES)?></td>
					</tr>
					<tr>
						<td>Contraseña:</td>
						<td><?=htmlspecialchars($password, ENT_QUOTES)?></td>
					</tr>
					<tr>
						<td>Correo electronico:</td>
						<td><?=htmlspecialchars($email, ENT_QUOTES)?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>