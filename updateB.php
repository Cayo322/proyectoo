<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$bd->prepare('SELECT * FROM libros WHERE id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: index.php');
	}


	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$apellidos=$_POST['genero'];
		$telefono=$_POST['precio'];
		$ciudad=$_POST['editorial'];
		$correo=$_POST['edicion'];
		$id=(int) $_GET['id'];

		if(!empty($nombre) && !empty($genero) && !empty($precio) && !empty($editorial) && !empty($edicion) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_update=$con->prepare(' UPDATE clientes SET  
					nombre=:nombre,
					genero=:genero,
					precio=:precio,
					editorial=:editorial,
					edicion=:edicion
					WHERE id=:id;'
				);
				$consulta_update->execute(array(
					':nombre' =>$nombre,
					':genero' =>$genero,
					':precio' =>$precio,
					':editorial' =>$editorial,
					':edicion' =>$edicion,
					':id' =>$id
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
	<title>Editar libro</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>CRUD EN PHP CON MYSQL</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['nombre']; ?>" class="input__text">
				<input type="text" name="genero" value="<?php if($resultado) echo $resultado['genero']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="precio" value="<?php if($resultado) echo $resultado['precio']; ?>" class="input__text">
				<input type="text" name="editorial" value="<?php if($resultado) echo $resultado['editorial']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="edicion" value="<?php if($resultado) echo $resultado['edicion']; ?>" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
