<?php 
  require  "common.inc.php";
  $action = request_get("action",-1);
  $usr_id =  request_get("usr_id","");  
  top(); 
?>




     <form class="form-signin" action="cadastro.php" method="POST" role="form" > 

		<fieldset class="w-100"  >        
        <h2 class="form-signin-heading" align="center">Cadastro</h2>

		<?php
		$usr_id = $_GET["usr_id"];

          $gera_primeira_senha = request_get("gera_primeira_senha","");

            if($gera_primeira_senha!="")
            {
              $sucesso_cria_senha = gera_primeira_senha_acesso($usr_id);

              if($sucesso_cria_senha)
              {
                adiciona_mensagem_status(MSG_TIPO_SUCESSO,"Senha de primeiro acesso foi gerada e enviada para o email principal do cestante, com cópia para os emails alternativos.");        
              }
              else
              {
                adiciona_mensagem_status(MSG_TIPO_ERRO,"Erro ao tentar gerar senha de primeiro acesso e enviá-la ao cestante, verifique se digitou seu e-mail corretamente.");          
              }
              escreve_mensagem_status();      
            }

		    ?>


            <br>
        	  
   		</fieldset>

      <br>
			<div class="clear"></div>
			<div align="right">Voltar para o Menu Principal?&nbsp;<a href="../index.php">Voltar</a></div>
			<div align="right">Já tem cadastro?&nbsp;<a href="login.php">Clique aqui para fazer login</a></div>	
			<div class="clear"></div>
			
      </form>
          
  
<?php
footer();
?>