
<?php 

require_once("../conexao.php");


@session_start();

$cpf_usuario = @$_SESSION['cpf_usuario'];

//includes para o mercado pago
include_once("../mercadopago/lib/mercadopago.php");
include_once("../mercadopago/PagamentoMP.php");

$pagar = new PagamentoMP;

//TRAZER OS DADOS DA VENDA

$res = $pdo->query("SELECT * from vendas where cliente = '$cpf_usuario' order by id desc limit 1");
  $dados = $res->fetchAll(PDO::FETCH_ASSOC);
  $total_venda = @$dados[0]['total'];
  $id_venda = @$dados[0]['id'];
  $nome_do_produto = 'Compra no Delivery';

  $btn = $pagar->PagarMP($id_venda, $nome_do_produto, (float)$total_venda, $url_site);
            

echo $btn;


 
                    