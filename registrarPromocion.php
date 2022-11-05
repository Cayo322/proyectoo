<?php
//print_r($_POST);
if (empty($_POST["txtPromocion"]) || empty($_POST["txtDuracion"])) {
    header('Location: index.php');
    exit();
}

include_once 'conexion.php';
$promocion = $_POST["txtPromocion"];
$duracion = $_POST["txtDuracion"];
$id = $_POST["id"];


$sentencia = $bd->prepare("INSERT INTO promociones(promocion,duracion,id_clientes) VALUES (?,?,?);");
$resultado = $sentencia->execute([$promocion,$duracion, $id ]);

if ($resultado === TRUE) {
    header('Location: agregarPromocion.php?id='.$id);
} 
