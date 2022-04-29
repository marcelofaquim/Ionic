<?php 
require_once("../conexao.php");
$id_car = $_POST['idcarrinho'];

$res = $pdo->query("SELECT * from sabores_itens where id_car = '$id_car'");
          $dados = $res->fetchAll(PDO::FETCH_ASSOC);
          for ($i=0; $i < count($dados); $i++) { 
            foreach ($dados[$i] as $key => $value) {
            }

       $id_sab = $dados[$i]['id_sab'];
       $id_item_sab = $dados[$i]['id'];
       $res2 = $pdo->query("SELECT * from sabores where id = '$id_sab'");
        $dados2 = $res2->fetchAll(PDO::FETCH_ASSOC);
        $nome_sab = $dados2[0]['nome'];
		$valor_sab = $dados2[0]['valor'];
		 $valor_sab = number_format( $valor_sab , 2, ',', '.');

		echo '<span> <i class="fas fa-check text-success"></i> '. $nome_sab . ' - R$ ' . $valor_sab .'<a href="" onclick="deletarItemSab('.$id_item_sab.')" class="ml-1 text-danger"><i class="fas fa-times"></i></a> </span><br> ';
}


?>