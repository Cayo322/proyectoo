<?php 
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$apellidos=$_POST['genero'];
		$telefono=$_POST['precio'];
		$ciudad=$_POST['editorial'];
		$correo=$_POST['edicion'];

		if(!empty($nombre) && !empty($genero) && !empty($precio) && !empty($editorial) && !empty($edicion) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_insert=$bd->prepare('INSERT INTO libros(nombre,genero,precio,editorial,edicion) VALUES(:nombre,:genero,:precio,:editorial,:edicion)');
				$consulta_insert->execute(array(
					':nombre' =>$nombre,
					':Genero' =>$genero,
					':precio' =>$precio,
					':editorial' =>$editorial,
					':edicion' =>$edicion
				));
				header('Location: index.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}

	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Libro</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>BIBLIOTECA</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" placeholder="Nombre" class="input__text">
				<input type="text" name="genero" placeholder="genero" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="precio" placeholder="precio" class="input__text">
				<input type="text" name="editorial" placeholder="editorial" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="edicion" placeholder="edicion" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
