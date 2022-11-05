<?php 
$database = "grupo2";
$user = "grupo2";
$password = "sw%TD8k7Y7*8";

try {
	$bd = new PDO (
		'mysql:host=bdmysql.testing-apps.com;
		dbname='.$database,
		$user,
		$password,
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	);
} catch (Exception $e) {
	echo "Problema con la conexion: ".$e->getMessage();
}
?>