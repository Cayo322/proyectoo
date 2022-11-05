<?php
if (!isset($_GET['id'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'conexion.php';
$id = $_GET['id'];

$sentencia = $bd->prepare("SELECT pro.promocion, pro.duracion , pro.id_clientes, per.nombre , per.apellidos ,per.ciudad,per.telefono , per.correo 
  FROM promociones pro 
  INNER JOIN clientes per ON per.id = pro.id_clientes 
  WHERE pro.id = ?;");
$sentencia->execute([$id]);
$clientes = $sentencia->fetch(PDO::FETCH_OBJ);
$libros = $sentencia->fetch(PDO::FETCH_OBJ);

    $url = 'https://whapi.io/api/send';
    $data = [
        "app" => [
            "id" => '51918263709',
            "time" => '1654728819',
            "data" => [
                "recipient" => [
                    "id" => '51'.$clientes->telefono
                ],
                "message" => [[
                    "time" => '1654728819',
                    "type" => 'text',
                    "value" => 'Estimado(a) *'.strtoupper($clientes->nombre).' '.strtoupper($clientes->apellidos).'* La vida es demasiado corta como para leer un libro malo, por eso te ofrecemos el siguiente libro *'.strtoupper($clientes->promocion).'* '.($clientes->duracion).''
                ]]
            ]
        ]
    ];
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode($data),
            'header' =>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    header('Location: agregarPromocion.php?id='.$clientes->id_clientes);
?>
