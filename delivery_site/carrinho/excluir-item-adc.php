<?php 

require_once("../conexao.php");
@session_start();

$id = $_POST['id'];


$pdo->query("DELETE FROM adicionais_itens where id = '$id'");

echo "Excluido com Sucesso!!";


?>