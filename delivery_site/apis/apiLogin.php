<?php

include_once('conexao.php');

$postjson = json_decode(file_get_contents('php://input'), true);


if($postjson['requisicao'] == 'login'){

    
    $query = $pdo->query("SELECT * from usuarios where usuario = '$postjson[usuario]' and senha = '$postjson[senha]'");
    
    $res = $query->fetchAll(PDO::FETCH_ASSOC);

   for ($i=0; $i < count($res); $i++) { 
      foreach ($res[$i] as $key => $value) {
      }
     $nivel = $res[$i]['nivel'];
     $dados = array(
       'id' => $res[$i]['id'],
       'nome' => $res[$i]['nome'],
       'usuario' => $res[$i]['usuario'],
        'senha' => $res[$i]['senha'],
        'cpf' => $res[$i]['cpf'],
        'nivel' => $res[$i]['nivel'],
            
        
     );

 }

        if(count($res) > 0){
                $result = json_encode(array('success'=>true, 'result'=>$dados));


            }else{
                $result = json_encode(array('success'=>false, 'msg'=>'Dados Incorretos!'));

            }
            echo $result;




}else if($postjson['requisicao'] == 'add'){

    $nome = $postjson['nome'];
    $email = $postjson['usuario'];
    $cpf = $postjson['cpf'];
    $telefone = $postjson['telefone'];
    $senha = $postjson['senha'];
    $rua = $postjson['rua'];
    $numero = $postjson['numero'];
    $bairro = $postjson['bairro'];
    $cidade = $postjson['cidade'];
    $cep = $postjson['cep'];



//CONSULTA PARA TRAZER O CPF E EMAIL CASO JÁ EXISTA NO BANCO
$res = $pdo->query("SELECT * from usuarios where usuario = '$email' or cpf = '$cpf'");

$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);
  if($linhas > 0){
    $email_recup = $dados[0]['usuario'];
    $cpf_recup = $dados[0]['cpf'];
}


if($cpf == @$cpf_recup){
    $texto = 'CPF já Cadastrado!';
    $result = json_encode(array('success'=>true, 'result'=>$texto));
    echo $result;
    exit();
}

if($email == @$email_recup){
    $texto = 'Email já Cadastrado!';
    $result = json_encode(array('success'=>true, 'result'=>$texto));
    echo $result;
    exit();
}


$res = $pdo->prepare("INSERT into usuarios (nome, cpf, telefone, usuario, senha, nivel) values (:nome, :cpf, :telefone, :usuario, :senha, :nivel)");

    $res->bindValue(":nome", $nome);
    $res->bindValue(":usuario", $email);
    $res->bindValue(":cpf", $cpf);
    $res->bindValue(":senha", $senha);
    $res->bindValue(":nivel", 'Cliente');
    $res->bindValue(":telefone", $telefone);
   

    $res->execute();

    
    $res = $pdo->prepare("INSERT into clientes (nome, cpf, telefone, email, rua, numero, bairro, cidade, cep) values (:nome, :cpf, :telefone, :usuario, :rua, :numero, :bairro, :cidade, :cep)");

    $res->bindValue(":nome", $nome);
    $res->bindValue(":usuario", $email);
    $res->bindValue(":cpf", $cpf);
    $res->bindValue(":telefone", $telefone);
    $res->bindValue(":rua", $rua);
    $res->bindValue(":numero", $numero);
    $res->bindValue(":bairro", $bairro);
    $res->bindValue(":cidade", $cidade);
    $res->bindValue(":cep", $cep);

    $res->execute();


    $texto = 'Salvo com Sucesso!';
  
    if(count($res) > 0){
      $result = json_encode(array('success'=>true, 'result'=>$texto));

    }else{
      $result = json_encode(array('success'=>false));
    }
    
    echo $result;

    


}else if($postjson['requisicao'] == 'listar-locais'){
	
	$query = $pdo->query("SELECT * from locais order by nome asc");
	
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $total = count($res);

 	for ($i=0; $i < count($res); $i++) { 
      foreach ($res[$i] as $key => $value) {
      }
 			$dados[] = array(
 			'id' => $res[$i]['id'],
 			'nome' => $res[$i]['nome'],
 		);
 }

    if(count($res) > 0){
        $result = json_encode(array('success'=>true, 'result'=>$dados, 'total'=>$total));

    }else{
        $result = json_encode(array('success'=>false, 'result'=>'0'));
    }

    echo $result;





// }else if($postjson['requisicao'] == 'recuperar'){

// $email_usuario = $postjson['usuario'];


// $res = $pdo->prepare("SELECT * from usuarios where usuario = :usuario");

// 	$res->bindValue(":usuario", $email_usuario);
// 	$res->execute();

// 	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
// 	$linhas = count($dados);

// 	if($linhas > 0){
// 		$nome_usu = $dados[0]['nome'];
// 		$senha_usu = $dados[0]['senha'];
// 		$nivel_usu = $dados[0]['nivel'];

// 	}else{
// 		$texto = 'Email não Cadastrado!';
// 		$result = json_encode(array('success'=>true, 'result'=>$texto));
// 		echo $result;
// 		exit();
// 	}

	
	
// 	//AQUI VAI O CÓDIGO DE ENVIO DO EMAIL
// 	$to = $email_usuario;
// 	$subject = 'Recuperação de Senha Burguer Freitas';

// 	$message = "

// 	Olá $nome_usu!! 
// 	<br><br> Sua senha é <b>$senha_usu </b>

// 	<br><br> Ir Para o Sistema -> <a href='$url_site'  target='_blank'> Clique Aqui </a>

// 	";

// 	$remetente = $email_adm;
// 	$headers = 'MIME-Version: 1.0' . "\r\n";
// 	$headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";
// 	$headers .= "From: " .$remetente;
// 	@mail($to, $subject, $message, $headers);

	

   


//        $texto = 'Senha Enviada para o Email';
  
//       if(count($res) > 0){
//         $result = json_encode(array('success'=>true, 'result'=>$texto));


//         }else{
//         $result = json_encode(array('success'=>false));
    
//         }
//      echo $result;




}




?>