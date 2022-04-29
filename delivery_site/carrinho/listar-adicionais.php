<?php 
require_once("../conexao.php");
$id_prod = $_POST['idproduto'];

$res_todos = $pdo->query("SELECT * from produtos where id = '$id_prod'");
$dados_total = $res_todos->fetchAll(PDO::FETCH_ASSOC);
$id_cat = $dados_total[0]['categoria'];




echo "<option value=''>Selecione um Adicional</option>";

$res = $pdo->query("SELECT * from adicionais where id_cat = '$id_cat'");
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);
          for ($i=0; $i < count($dados); $i++) { 
            foreach ($dados[$i] as $key => $value) {
            }

            $nome_adc = $dados[$i]['nome'];
			$valor_adc = $dados[$i]['valor'];
			$id_adc = $dados[$i]['id'];
			$valor_adc = number_format($valor_adc, 2, ',', '.');

           echo "<option value='" . $id_adc . "'>" . $nome_adc . ' - R$ ' . $valor_adc . "</option>";

       }

      




 ?>


