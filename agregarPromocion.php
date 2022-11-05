<?php include 'template/header.php' ?>

<?php
include_once "conexion.php";
$id = $_GET['id'];

$sentencia = $bd->prepare("select * from clientes where id = ?;");
$sentencia->execute([$id]);
$clientes = $sentencia->fetch(PDO::FETCH_OBJ);

$sentencia_promocion = $bd->prepare("select * from promociones where id_clientes = ?;");
$sentencia_promocion->execute([$id]);
$promocion = $sentencia_promocion->fetchAll(PDO::FETCH_OBJ); 
//print_r($persona);
?>

<div class="contenedor">
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="body">
                <div class="contenedor">
                    Ingresar datos para emitir Promocion : <br><?php echo $clientes->nombre.' '.$clientes->apellidos.' '.$clientes->ciudad; ?>
                </div>
                <form class="formulario" method="POST" action="registrarPromocion.php">
                    <div class="mb-3">
                        <label class="form-label">Promocion: </label>
                        <input type="text" class="form-control" name="txtPromocion" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duración de la Promocion: </label>
                        <input type="text" class="form-control" name="txtDuracion" autofocus required>
                    </div>
                    <div class="d-grid">
                    <input type="hidden" name="id" value="<?php echo $clientes->id; ?>"><P></P>
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
        <div class="contenedor">
            <div class="contenedor">
                <div class="contenedor">
                    Lista de Promociones
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Promocion</th>
                                <th scope="col">Duracion</th>
                                <th scope="col" colspan="3">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($promocion as $dato) {
                            ?>
                                <tr>
                                    <td scope="row"><?php echo $dato->id; ?></td>
                                    <td><?php echo $dato->promocion; ?></td>
                                    <td><?php echo $dato->duracion; ?></td>
                                    <td><a class="text-primary" href="enviarMensaje.php?id=<?php echo $dato->id; ?>"><i class="bi bi-cursor"></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
