<?php 

include_once("config.php");

date_default_timezone_set('America/Sao_Paulo');

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$host;charset=utf8", "$usuario", "$senha");

} catch (Exception $e) {
	echo "Erro ao conectar com o banco de dados! ".$e;
}



//VARIAVEIS GLOBAIS QUE VEM DO BANCO DE DADOS


//VARIAVEIS PARA O PEDIDO

$res2 = $pdo->query("SELECT * from config where id = 1");
  $dados2 = $res2->fetchAll(PDO::FETCH_ASSOC);
  $linhas = count($dados2);
  if($linhas == 0){
  	$pdo->query("INSERT INTO config (previsao_minutos, taxa_entrega, abertura, fechamento) values (30,5, '16:00', '00:00')");
  }else{
  	$previsao_minutos = @$dados2[0]['previsao_minutos'];
  	$taxa_entrega = @$dados2[0]['taxa_entrega'];
  	$abertura = @$dados2[0]['abertura'];
  	$fechamento = @$dados2[0]['fechamento'];
  }


 ?>