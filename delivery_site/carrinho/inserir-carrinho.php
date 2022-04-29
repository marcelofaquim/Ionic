<?php 

require_once("../conexao.php");
@session_start();


$id_produto = $_POST['idproduto'];
$cpf_cliente = @$_SESSION['cpf_usuario'];


//VERIRICAR SE O PRODUTO JÁ EXISTE NO CARRINHO
$res_p = $pdo->query("SELECT * from carrinho where id_produto = '$id_produto' and id_venda = 0 and cpf = '$cpf_cliente' ");
$dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
$linhas_p = count($dados_p);
if($linhas_p > 0){
	$quant_p = $dados_p[0]['quantidade'];
	$quant_p = $quant_p + 1;

	$res = $pdo->query("UPDATE carrinho set quantidade = '$quant_p' where id_produto = '$id_produto' and cpf = '$cpf_cliente'");
	echo "Cadastrado com Sucesso!!";
	exit();


}


if($cpf_cliente != ''){


$quantidade = 1;

$res = $pdo->query("INSERT into carrinho (id_venda, id_produto, cpf, quantidade, data) values ('0', '$id_produto', '$cpf_cliente', '$quantidade', curDate())");

	
}	

echo "Cadastrado com Sucesso!!";




?>