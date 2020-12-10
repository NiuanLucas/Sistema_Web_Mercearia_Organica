<?php  
  require  "common.inc.php"; 
  verifica_seguranca();
  top();
?>

<?php 
     
	 campanha_atualizacao_cadastro();
	 
	 echo(get_texto_interno("txt_pagina_inicio"));

	if($_SESSION[PAP_ADM] || $_SESSION[PAP_RESP_PEDIDO] || $_SESSION[PAP_RESP_NUCLEO]  || $_SESSION[PAP_RESP_MUTIRAO] || $_SESSION[PAP_ACOMPANHA_PRODUTOR] || $_SESSION[PAP_ACOMPANHA_RELATORIOS] || $_SESSION[PAP_RESP_ENTREGA] || $_SESSION[PAP_RESP_FINANCAS] )			  
			{
				echo "<a href='chamadas.php'> <button type='button' class='btn btn-primary'>
				 Acessar Planilha de pedidos </button> </a> </br></br>";

			}
	 
 	 footer();
?>