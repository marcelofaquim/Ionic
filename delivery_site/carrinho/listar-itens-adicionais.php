<?php 
require_once("../conexao.php");
$id_car = $_POST['idcarrinho'];

$res = $pdo->query("SELECT * from adicionais_itens where id_car = '$id_car'");
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);
          for ($i=0; $i < count($dados); $i++) { 
            foreach ($dados[$i] as $key => $value) {
            }

       $id_adc = $dados[$i]['id_adc'];
       $id_item_adc = $dados[$i]['id'];
       $res2 = $pdo->query("SELECT * from adicionais where id = '$id_adc'");
        $dados2 = $res2->fetchAll(PDO::FETCH_ASSOC);
        $nome_adc = $dados2[0]['nome'];
		$valor_adc = $dados2[0]['valor'];
		 $valor_adc = number_format( $valor_adc , 2, ',', '.');

		echo '<span> <i class="fas fa-check"></i> '. $nome_adc . ' - R$ ' . $valor_adc .'<a href="" onclick="deletarItemAdc('.$id_item_adc.')" class="ml-1 text-warning"><i class="fas fa-times"></i></a> </span><br> ';
}


?>