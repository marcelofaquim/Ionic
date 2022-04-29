<?php 

include_once("conexao.php");

$bairro = $_POST['bairro'];

//CONSULTA PARA TRAZER O CPF E EMAIL CASO JÁ EXISTA NO BANCO
$res = $pdo->query("SELECT * from locais where nome = '$bairro' ");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
echo $dados[0]['valor'];

?>