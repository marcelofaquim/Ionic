
<!--MODAL PARA CARRINHO -->
<div class="modal fade" id="modal-carrinho" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <h5 class="cart-inline-title">Carrinho:<span id="total_itens" class="ml-1"> </span> Produtos</h5>
         <input type="hidden" id="txtquantidade">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
   
   <?php if(@$_SESSION['cpf_usuario'] == ''){
    echo 'Você precisa está Logado, faça seu login clicando <a class="vermelho-link" href="login" target="_blank" title="Ir para o Login"> aqui </a>, caso não tenha login faça seu cadastro!';

   }else{ ?>
    <div id="listar-carrinho">
    
    </div>
  <?php } ?>
  </div>
  
</div>
</div>
</div>





<!--MODAL PARA CARRINHO -->
<div class="modal fade" id="modal-adicionais" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <h5 class="cart-inline-title">Adicionais</h5>
         <input type="hidden" id="txtquantidade">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    


                 
          <input type="hidden" name="id_car" id="id_car">
          <select class='form-control form-control-sm text-dark' name='adicional' id='adicional'>
           
          </select>
       
      
           <div id="listar-selecionados" class="mt-3">
    
          </div>
 
     
   
 
  </div>
  
</div>
</div>
</div>



<div class="modal fade" id="modal-sabores" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <h5 class="cart-inline-title">Escolha os Sabores</h5>
         <input type="hidden" id="txtquantidade">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body">
    

          <p>Escolha um ou dois Sabores para Pizza!</p>
                 
          <input type="hidden" name="id_car" id="id_car">
           
            <div class="form-group">
              
              <select class="form-control form-control-sm" name="sabor" id="sabor">
                <option value="">Selecione um Sabor</option>
                <?php 
                  
                //TRAZER TODOS OS REGISTROS EXISTENTES
                $res = $pdo->query("SELECT * from sabores order by nome asc");
                $dados = $res->fetchAll(PDO::FETCH_ASSOC);

                for ($i=0; $i < count($dados); $i++) { 
                  foreach ($dados[$i] as $key => $value) {
                  }

                  $id_item = $dados[$i]['id'];  
                  $nome_item = $dados[$i]['nome'];
                  $valor_item = $dados[$i]['valor'];
                  $valor_item = number_format($valor_item, 2, ',', '.');
                 
                    echo '<option value="'.$id_item.'">'.$nome_item.' - Acréscimo de R$ '.$valor_item.'</option>';
                  
                  }
                  
                
                ?>
              </select>
            </div>
                
      
           <div id="listar-sabores" class="mt-3">
    
          </div>


          <small><div align="center" id="mensagem-sabor" class="mt-3"></div>
    
          </div>
 
     
   
 
  </div>
  
</div>
</div>
</div>



<!--AJAX PARA INSERÇÃO DOS DADOS VINDO DE UMA FUNÇÃO -->
<script>
function carrinhoModal(idproduto) {
  
  
     event.preventDefault();
            
            $.ajax({

                url: "carrinho/inserir-carrinho.php",
                method: "post",
                data: {idproduto},
                dataType: "text",
                success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem == 'Cadastrado com Sucesso!!'){
                        atualizarCarrinho();
                       $("#modal-carrinho").modal("show");

                    }else{
                        
                       
                    }
                    
                    $('#mensagem').text(mensagem)

                },
                
            })
}
</script>







<!--AJAX PARA LISTAR OS DADOS -->
<script type="text/javascript">
  $(document).ready(function(){
    
    

    $.ajax({
      url:  "carrinho/listar-carrinho.php",
      method: "post",
      data: $('#frm').serialize(),
      dataType: "html",
      success: function(result){
        $('#listar-carrinho').html(result)

      },

      
    })
  })
</script>




<script>
function atualizarCarrinho() {
    $.ajax({
      url:  "carrinho/listar-carrinho.php",
      method: "post",
      data: $('#frm').serialize(),
      dataType: "html",
      success: function(result){
        $('#listar-carrinho').html(result)

      },
     })
}
</script>



<script>
function deletarCarrinho(id) {

   event.preventDefault();
            
            $.ajax({

                url: "carrinho/excluir-carrinho.php",
                method: "post",
                data: {id},
                dataType: "text",
                success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem == 'Excluido com Sucesso!!'){
                        atualizarCarrinho();
                       //$("#modal-carrinho").modal("show");

                    }else{
                        
                       
                    }
                    
                    $('#mensagem').text(mensagem)

                },
                
            })
   
}
</script>



<script type="text/javascript">
   function editarCarrinho(id) {
        
        var quantidade = document.getElementById('txtquantidade').value;
        event.preventDefault();
            
            $.ajax({

                url: "carrinho/editar-carrinho.php",
                method: "post",
                data: {id, quantidade},
                dataType: "text",
                success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem == 'Editado com Sucesso!!'){
                        atualizarCarrinho();
                       //$("#modal-carrinho").modal("show");

                    }else{
                        
                       
                    }
                    
                    $('#mensagem').text(mensagem)

                },
                
            })

        
      }
</script>




<script>
function adicionais(idproduto, idcarrinho) {
  
     event.preventDefault();
     
     document.getElementById('id_car').value = idcarrinho;
     listarAdicionais();

     $.ajax({
      url:  "carrinho/listar-adicionais.php",
      method: "post",
      data: {idproduto},
      dataType: "html",
      success: function(result){
        $('#adicional').html(result)

      },
     })


     $("#modal-adicionais").modal("show");      
}
</script>


<script type="text/javascript">
  $('#adicional').change(function(){
    idcarrinho = document.getElementById('id_car').value;
    idadicional = document.getElementById('adicional').value;
    
    $.ajax({
      url:  "carrinho/inserir-adicional.php",
      method: "post",
      data: {idcarrinho, idadicional},
      dataType: "html",
      success: function(result){
        if(result.trim() === 'Salvo'){
          listarAdicionais();
          atualizarCarrinho();
        }
               

      },
     })
  })


function listarAdicionais(){
  idcarrinho = document.getElementById('id_car').value;
     
     $.ajax({
      url:  "carrinho/listar-itens-adicionais.php",
      method: "post",
      data: {idcarrinho},
      dataType: "html",
      success: function(result){
        $('#listar-selecionados').html(result)

      },
     })
}

</script>





<script>
function deletarItemAdc(id) {

   event.preventDefault();
            
            $.ajax({

                url: "carrinho/excluir-item-adc.php",
                method: "post",
                data: {id},
                dataType: "text",
                success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem == 'Excluido com Sucesso!!'){
                        listarAdicionais();
                        atualizarCarrinho();
                       //$("#modal-carrinho").modal("show");

                    }else{
                        
                       
                    }
                    
                    $('#mensagem').text(mensagem)

                },
                
            })
   
}
</script>





<script>
function sabores(idcarrinho) {
  
     event.preventDefault();
     
     
     document.getElementById('id_car').value = idcarrinho;
     listarSabores()
          
     $("#modal-sabores").modal("show");      
}
</script>





<script type="text/javascript">
  $('#sabor').change(function(){
    idcarrinho = document.getElementById('id_car').value;
    idsabor = document.getElementById('sabor').value;
    console.log('sss' + idcarrinho);
    $.ajax({
      url:  "carrinho/inserir-sabor.php",
      method: "post",
      data: {idcarrinho, idsabor},
      dataType: "html",
      success: function(result){
        if(result.trim() === 'Salvo'){
          listarSabores();
          atualizarCarrinho();
          $('#mensagem-sabor').text("")
        }else{
          $('#mensagem-sabor').addClass('text-danger')
          $('#mensagem-sabor').text(result)
        }
               

      },
     })
  })


function listarSabores(){
  idcarrinho = document.getElementById('id_car').value;
     
     $.ajax({
      url:  "carrinho/listar-itens-sabores.php",
      method: "post",
      data: {idcarrinho},
      dataType: "html",
      success: function(result){
        $('#listar-sabores').html(result)

      },
     })
}

</script>





<script>
function deletarItemSab(id) {

   event.preventDefault();
            
            $.ajax({

                url: "carrinho/excluir-item-sab.php",
                method: "post",
                data: {id},
                dataType: "text",
                success: function(mensagem){

                    $('#mensagem').removeClass()

                    if(mensagem == 'Excluido com Sucesso!!'){
                        listarSabores();
                        atualizarCarrinho();
                       //$("#modal-carrinho").modal("show");
                       $('#mensagem-sabor').text("")

                    }else{
                        
                       
                    }
                    
                    $('#mensagem').text(mensagem)

                },
                
            })
   
}
</script>