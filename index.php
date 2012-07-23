<?php
	include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Inicio</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		</head>
	<body>
		<div id="head">
		</div>
		<div id="categories">
		</div>
		<div id="content">
		</div>
		<div id="user">
			<?php 		
				if($_SESSION["user"]->isLogged()){ 
			?>
				<div id="userInfo">
					Hola <?php echo $_SESSION["user"]->getNickname(); ?><br />
					Tus puntos <?php $_SESSION["user"]->getPoints(); ?><br />
					<input type="submit" value="Salir" />
				</div>
			<?php } else{ ?>
				<form method="POST">
					<table>
						<tr>
							<td>Email:</td>
							<td><input type="text" name="email" /></td>
						</tr>
						<tr>
							<td>Contrase&ntilde;a:</td>
							<td><input type="password" name="password" /></td>
						<tr>
							<td></td>
							<td><input type="submit" value="Entrar" /></td>
						</tr>
					</table>
				</form>		
				<div id="userError">
				</div>
			<?php } ?>
		</div>
	</body>
</html>
