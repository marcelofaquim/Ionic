<?php 

require_once("../conexao.php");
@session_start();

$id = $id_venda;
$pdo->query("UPDATE vendas set status = 'Iniciado', pago = 'Sim' where id = '$id'");



?>