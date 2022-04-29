<?php 
require_once("../conexao.php");
$id_car = $_POST['idcarrinho'];
$id_adc = $_POST['idadicional'];

if($id_adc != ""){
	$pdo->query("INSERT into adicionais_itens (id_car, id_adc) values ('$id_car', '$id_adc')");

	echo 'Salvo';
}

?>