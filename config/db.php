<?php
$dsn ="mysql:host=localhost;dbname=clientes";
$username = "root";
$password = "";


//crear conexion
try{
	$pdo = new PDO($dsn, $username,$password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch( PDOException $e){
	echo 'Conexion fallida: ' .$e->getMessage();
}
?>
