<?php

include_once('conexao.php');

$postjson = json_decode(file_get_contents('php://input'), true);


if($postjson['requisicao'] == 'listar-produtos'){

  //esse variável criar depois da página categorias pronta; é para poder puxar somente os produtos pertencente a certa categoria (botão ver)
  $id_cat = $postjson['id_cat'];
  
  //se tiver o id da categoria fazer a busca
  if($id_cat > 0){
    $query = $pdo->query("SELECT * from produtos where categoria = '$id_cat' order by vendas desc limit $postjson[start], $postjson[limit]");
    
  }else {
    $query = $pdo->query("SELECT * from produtos where adicional is null order by vendas desc limit $postjson[start], $postjson[limit]");
  }


    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total = count($res);

    for ($i=0; $i < count($res); $i++) { 
      foreach ($res[$i] as $key => $value) {
      }
 			$dados[] = array(
 			'id' => $res[$i]['id'],
 			'nome' => $res[$i]['nome'],
 			'descricao' => $res[$i]['descricao'],
			'valor' => $res[$i]['valor'],
      'imagem' => $res[$i]['imagem'],  
 		);
 }

  if(count($res) > 0){
    $result = json_encode(array('success'=>true, 'result'=>$dados, 'total'=>$total));
             

  }else{
    $result = json_encode(array('success'=>false, 'result'=>'0'));
  }
  
  echo $result;


}else if($postjson['requisicao'] == 'listar-cat'){
	
  $query = $pdo->query("SELECT * from categorias order by produtos desc limit $postjson[start], $postjson[limit]");

  $res = $query->fetchAll(PDO::FETCH_ASSOC);
  $total = count($res); 
   for ($i=0; $i < count($res); $i++) { 
    foreach ($res[$i] as $key => $value) {
    }
   $dados[] = array(
    'id' => $res[$i]['id'],
    'nome' => $res[$i]['nome'],
    'descricao' => $res[$i]['descricao'],
    'produtos' => $res[$i]['produtos'],
    'imagem' => $res[$i]['imagem'],                   
   );
}

  if(count($res) > 0){
    $result = json_encode(array('success'=>true, 'result'=>$dados, 'total'=>$total));
    'total'=>$total 

  }else{
    $result = json_encode(array('success'=>false, 'result'=>'0'));
  }
  
  echo $result;

}

?>