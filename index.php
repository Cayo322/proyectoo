<?php
	include_once 'conexion.php';

	$sentencia_select=$bd->prepare('SELECT *FROM clientes ORDER BY id DESC');
	$sentencia_select1=$bd->prepare('SELECT *FROM libros ORDER BY id DESC');
	$sentencia_select->execute();
	$sentencia_select1->execute();
	$resultado=$sentencia_select->fetchAll();
	$resultado1=$sentencia_select1->fetchAll();

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$bd->prepare('
			SELECT *FROM clientes WHERE nombre LIKE :campo OR apellidos LIKE :campo;'
			
		);
		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));
		$resultado=$select_buscar->fetchAll();
	}

	// metodo buscar
	if(isset($_POST['btn_buscar1'])){
		$buscar_text1=$_POST['buscar'];
		$select_buscar1=$bd->prepare('
			SELECT *FROM libros WHERE nombre LIKE :campo OR genero LIKE :campo;'
			
		);
		$select_buscar1->execute(array(
			':campo' =>"%".$buscar_text1."%"
		));
		$resultado1=$select_buscar1->fetchAll();
	}
	

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Inicio</title>
	<link rel="stylesheet" href="css/estilo.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.15.1/devicon.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>
<body>
	<div class="contenedor">
		<h2>Sistema Biblioteca</h2>
		<h3>Buscar cliente o libro </h3>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar nombre o apellidos" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar cliente">
				
				<a href="insert.php" class="btn btn__nuevo">Nuevo cliente</a>
				
			</form>
		</div>
		<br>
		<h2>Listado de clientes</h2>
		<br>
		<div>
		<table>
			<tr class="head">
				<td>Id</td>
				<td>Nombre</td>
				<td>Apellidos</td>
				<td>Teléfono</td>
				<td>Ciudad</td>
				<td>Correo</td>
				<td colspan="2">Acción</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr >
					<td><?php echo $fila['id']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['apellidos']; ?></td>
					<td><?php echo $fila['telefono']; ?></td>
					<td><?php echo $fila['ciudad']; ?></td>
					<td><?php echo $fila['correo']; ?></td>
					<td><a href="update.php?id=<?php echo $fila['id']; ?>"  class="btn__update" >Editar</a></td>
					<td><a href="delete.php?id=<?php echo $fila['id']; ?>" class="btn__delete">Eliminar</a></td>
					<td><a href="agregarPromocion.php?id=<?php echo $fila['id']; ?>" class="bi bi-whatsapp">Whatsapp</a></td>
				</tr>
			<?php endforeach ?>
		<table>
		</div>
		<br>
		<div class="barra__buscador1">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="buscar nombre" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				
				<input type="submit" class="btn" name="btn_buscar1" value="Buscar libro">
				
				<a href="insertB.php" class="btn btn__nuevo">Nuevo Libro</a>
			</form>
		</div>
		<br>
		<h2>Listado de Libros</h2>
		<br>
		<br>
		<div>
		<table>
			<tr class="head">
				<td>Id</td>
				<td>Nombre</td>
				<td>Genero</td>
				<td>Precio</td>
				<td>Editorial</td>
				<td>Edicion</td>
				<td colspan="2">Acción</td>
			</tr>
			<?php foreach($resultado1 as $fila1):?>
				<tr >
					<td><?php echo $fila1['id']; ?></td>
					<td><?php echo $fila1['nombre']; ?></td>
					<td><?php echo $fila1['genero']; ?></td>
					<td><?php echo $fila1['precio']; ?></td>
					<td><?php echo $fila1['editorial']; ?></td>
					<td><?php echo $fila1['edicion']; ?></td>
					<td><a href="updateB.php?id=<?php echo $fila1['id']; ?>"  class="btn__update" >Editar</a></td>
					<td><a href="deleteB.php?id=<?php echo $fila1['id']; ?>" class="btn__delete">Eliminar</a></td>
				</tr> 
			<?php endforeach ?>
		</table>
		</div>
	</div>
</body>
</html>