<?php 

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With'); 
header('Content-Type: application/json; charset=utf-8');  


//include_once("../config.php");

$banco = 'delivery';
$host = 'localhost';
$usuario = 'root';
$senha = '';

date_default_timezone_set('America/Sao_Paulo');


try {
	$pdo = new PDO("mysql:dbname=$banco;host=$host;charset=utf8", "$usuario", "$senha");

} catch (Exception $e) {
	echo "Erro ao conectar com o banco de dados! ".$e;
}



 ?>