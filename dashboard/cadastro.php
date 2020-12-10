<?php 
  require  "common.inc.php";
  $action = request_get("action",-1);
  $usr_id =  request_get("usr_id","");  
  top(); 
?>

<?php

if(isset($_POST["usr_nome_completo"])){
        $usr_nome_completo = $_POST["usr_nome_completo"];
        $usr_nome_curto = $_POST["usr_nome_curto"];
        $usr_email = $_POST["usr_email"];
        $usr_email_alternativo = $_POST["usr_email_alternativo"];
        $usr_senha = crypt($_POST["usr_senha"],PASSWORD_SALT);
        //$usr_senha = $_POST["usr_senha"];
        $usr_contatos = $_POST["usr_contatos"];
        $usr_endereco = $_POST["usr_endereco"];
        $usr_desde = $_POST["usr_desde"];
        $usr_atividades = $_POST["usr_atividades"];
        $usr_nuc = $_POST["usr_nuc"];
        $usr_associado = $_POST["usr_associado"];
        $usr_asso = $_POST["usr_asso"];
        $usr_archive = $_POST["usr_archive"];

        $inserir = "INSERT INTO usuarios ";
        $inserir .="(usr_nome_completo,usr_nome_curto,usr_email,usr_email_alternativo,usr_senha,usr_contatos,usr_endereco,usr_desde,usr_atividades,usr_nuc,usr_associado,usr_asso,usr_archive) ";
        $inserir .="VALUES ";
        $inserir .="('$usr_nome_completo','$usr_nome_curto','$usr_email','$usr_email_alternativo','$usr_senha','$usr_contatos','$usr_endereco','$usr_desde','$usr_atividades','$usr_nuc','$usr_associado','$usr_asso','$usr_archive')";

        $conecta = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $qInserir = mysqli_query($conecta,$inserir);


        
       if(!$qInserir) {
            die(" | Erro no Cadastro | Tente Novamente | ");   
            //die("| Erro no Banco de Dados | NOME:  " .$usr_nome_completo. " | SENHA: " .$usr_senha );   
        } else {



        //$usr_email = "niuanlucas@hotmail.com";
        $consulta  = "SELECT * FROM usuarios WHERE usr_email = '$usr_email' ";

        $info = mysqli_query($conecta, $consulta);
        if(!$info) {
        die(" Falha na Base de Dados Produto! ");  
        }

        //$dados = mysqli_fetch_assoc($info);
        //echo " <br> " .$dados['usr_nome_completo'].  "<br>" .$dados['usr_senha']. "<br>" .$dados['usr_id']. "<br>" ;
        //$usr_id = $dados['usr_id'];

        //$url = "cadastro_senha.php?action=0&usr_id=".$usr_id."&gera_primeira_senha=1";
        header("location: login.php?enter=1"); 

        }

      }


    ?>


     <form class="form-signin" action="cadastro.php" method="POST" role="form" > 

		<fieldset class="w-100"  >        
        <h2 class="form-signin-heading" align="center">Cadastro</h2>		

            <br>
            <label>*Nome Completo</label>
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
  	   	 	  <input type="text" class="form-control" placeholder="Nome Completo"  name="usr_nome_completo" id="usr_nome_completo" required="required" autofocus value="">
            </div>

            <br>
            <label>*Nome Curto</label>
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
            <input type="text" class="form-control" placeholder="Nome Curto"  name="usr_nome_curto" id="usr_nome_curto" required="required" autofocus value="">
            </div>
            <span class="help-block">Preferencialmente com no máximo 10 caracteres, 
            para economizar na impressão de relatórios.</span>

            
            <label>*Email Principal</label>
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input type="text" class="form-control" placeholder="Email Principal"  name="usr_email" id="usr_email" required="required" autofocus value="">
            </div>
            <span class="help-block">Utilizado para identificar a associação no sistema (login).</span>

            <label>Email Adicional</label>
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-inbox"></i></span>
            <input type="text" class="form-control" placeholder="Emails Adicionais"  name="usr_email_alternativo" id="usr_email_alternativo" autofocus value="">
            </div>
            <span class="help-block">Emails adicionais para recebimento das comunicações. Bastante útil para quem compartilha associação. Informar valores separados por vírgula (ex.: fulano@dominio.com.br, ciclano@dominio.com.br).</span>


            <label class="">Senha</label>
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" required="required" class="form-control" required="required"  name="usr_senha" id="usr_senha">
            </div><br>

            <label>*Contato</label>
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
            <input type="text" class="form-control" placeholder="ex.: 8888-9999/2333-4567" id="usr_contatos"  name="usr_contatos" required="required" autofocus value="">
            </div>
            <span class="help-block">Contatos (telefone celular, fixo,...). Ex.: 8888-9999 / 2333-4567</span>

            <label>*Endereço </label>
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
            <input type="text" class="form-control" placeholder="Endereço"  name="usr_endereco" id="usr_endereco"  required="required" autofocus value="">
            </div>
            <span class="help-block">Ex.: Rua Santo Amaro, 55 - Glória. Endereço de Entrega. </span>


            <label>*Data de Entrada</label>
            <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input type="date"  value="" required="required" class="data form-control" name="usr_desde" id="usr_desde" />  
            </div>
            <span class="help-block">Ex.: 15/09/2010. Data estimada em que você entrou na Mercearia Orgânica.</span>


            <label class="hidden">Atuais atividades na Mercearia Orgânica</label>
            <div class="input-group">
            <textarea  class="form-control mb-4 hidden" name="usr_atividades" id="usr_atividades" rows="6" required="required" value="Cliente"  placeholder="ex.: Acolhida, Comissão Gestora,...">Cliente</textarea>
            <span class="help-block mt-4 hidden">Exemplos: Acolhida; Comissão Gestora; Participação em mutirões no ano; Acompanhamento Produtor Ecobio;  Acompanhamento Produtor Biorga; Acompanhamento Produtor Amarea; ...</span>
            </div> 

                                
            <div class="form-group">
              <label>Aréa de Entrega</label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-list-alt"></i></span>
                <select name="usr_nuc" id="usr_nuc" class="form-control">
                  <option value="-1">SELECIONAR</option>
                    <?php
                     $conecta = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                      $nucleos = "SELECT nuc_id, nuc_nome_curto, nuc_archive ";
                      $nucleos.= "FROM nucleos ";
                      $nucleos.= "ORDER BY nuc_archive, nuc_nome_curto ";
                      $operacao_nucleos = mysqli_query($conecta, $nucleos);
                      if($operacao_nucleos)
                        { 
                        $arquivados=0;
                        while ($ruw = mysqli_fetch_array($operacao_nucleos,MYSQLI_ASSOC)) 
                        {
                      if(!$arquivados)
                        {
                      if($ruw["nuc_archive"]==1) 
                        {
                      echo("<option value='-1'>-------------</option>");                  
                          $arquivados=1;
                         }
                       }                   
                         echo("<option value='" . $ruw['nuc_id'] . "'");
                         echo (">" . $ruw['nuc_nome_curto'] . "</option>");                  
                                  }
                                }
                            ?> 
                        </select>                
                      </div>                  
                    </div>  
    

            <label class="hidden">Associado</label>
            <div class="input-group hidden">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
               <select name="usr_associado" id="usr_associado" class="form-control">
                  <option disabled value="1"  >Associado</option>
                  <option selected value="0"  selected >Não Associado</option>            
               </select>                       
            </div>

            <label class="hidden">Tipo Associação</label>
            <div class="input-group hidden">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
               <select name="usr_asso" id="usr_asso" class="form-control">
                <option disabled value="-1">SELECIONAR</option>
                <option selected value='1' selected>Normal</option>           
               </select>                       
            </div>


            <label class="hidden">Situação</label>
            <div class="input-group hidden">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
               <select name="usr_archive" id="usr_archive" class="form-control">
                <option selected="" value="0"  selected >Ativo</option>
                <option disabled="" value="1"  >Inativo</option>          
               </select>                       
            </div>

            <br>
        	  <input class="btn btn-lg btn-primary btn-block"  type="submit" name="Entrar" value="Entrar">

    </fieldset>

      <br>
			<div class="clear"></div>
			<div align="right">Voltar para o Menu Principal?&nbsp;<a href="../index.php">Voltar</a></div>
			<div align="right">Esqueceu a senha?&nbsp;<a href="senha_nova.php">Clique aqui para criar uma nova</a></div>
			<div align="right">Já tem cadastro?&nbsp;<a href="login.php">Clique aqui para fazer login</a></div>	
			<div class="clear"></div>
			
      </form>
          
  
<?php
footer();
?>