<?php 
require_once("../conexao.php");
$id_car = $_POST['idcarrinho'];
$id_sab = $_POST['idsabor'];

if($id_sab != ""){
	$res = $pdo->query("SELECT * from sabores_itens where id_car = '$id_car'");
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    $total_itens = @count($dados);
    if($total_itens >= $quantidade_sabores){
    	echo 'Você não pode escolher mais de '.$quantidade_sabores.' sabores!';
    }else{
    	$pdo->query("INSERT into sabores_itens (id_car, id_sab) values ('$id_car', '$id_sab')");

	echo 'Salvo';
    }

	

}

?>