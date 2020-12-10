<?php  
  require  "common.inc.php"; 
  verifica_seguranca($_SESSION[PAP_RESP_PEDIDO] || $_SESSION[PAP_RESP_NUCLEO]);
  top();
?>


<div class="panel panel-default">
  <div class="panel-heading">
     <strong>Áreas de entrega </strong>  <span class="pull-right">
		<a href="nucleo.php?action=<?php echo(ACAO_INCLUIR);?>" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-plus"></i> adicionar novo</a>
	</span>
  </div>
  <div class="panel-body">
	<?php  
  		$nuc_archive = isset($_REQUEST['nuc_archive']) ? mysqli_real_escape_string($conn_link,$_REQUEST['nuc_archive']) : 0 ;
		$nuc_nuct = isset($_REQUEST['nuc_nuct']) ? mysqli_real_escape_string($conn_link,$_REQUEST['nuc_nuct']) : -1 ;
	?>
  <form class="form-inline" action="nucleos.php" method="post" name="frm_filtro" id="frm_filtro" role="form">
     <fieldset>
     
     	<div class="form-group">
  				<label for="nuc_nuct">Tipo: </label>            
                 <select name="nuc_nuct" id="nuc_nuct" onchange="javascript:frm_filtro.submit();" class="form-control">
                        <option value="-1" <?php echo(($nuc_nuct==-1)?" selected" : ""); ?> >TODOS</option>
						<?php
                            
                            $sql = "SELECT nuct_id, nuct_nome ";
                            $sql.= "FROM nucleotipos ";
                            $sql.= "ORDER BY nuct_nome ";
                            $res = executa_sql($sql);
                            if($res)
                            {
                              while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) 
                              {
                                 echo("<option value='" . $row['nuct_id'] . "'");
                                 if($row['nuct_id']==$nuc_nuct) echo(" selected");
                                 echo (">" . $row['nuct_nome'] . "</option>");
                              }
                            }
                        ?>  
                 </select>    
         </div>     
         
              
    <div class="form-group">
  		<label for="nuc_archive">Situação: </label>&nbsp;
        <select name="nuc_archive" id="nuc_archive" onchange="javascript:frm_filtro.submit();" class="form-control">
                    <option value="-1" <?php echo(($nuc_archive==-1)?" selected" : ""); ?> >TODOS</option>
                    <option value="0"  <?php echo(($nuc_archive==0)?" selected" : ""); ?> >Ativos</option>
                    <option value="1"  <?php echo(($nuc_archive==1)?" selected" : ""); ?> >Inativos</option>            
              </select>                           
     </div>     
     </fieldset>
  </form>

  </div>

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>Tipo</th>
				<th>Nome Completo</th>
				<th>Nome Curto</th>
				<th>Email</th>
				<th>Cestantes</th>   
			</tr>
		</thead>
		<tbody>
				<?php
					
					$sql = "SELECT nuc_id, nuc_nome_curto, nuc_nome_completo, nuc_email,nuc_archive, nuct_nome, ";
					$sql.= "COUNT( usuarios.usr_nuc ) AS nuc_qtde_cestantes ";
					$sql.= "FROM nucleos ";
					$sql.= "LEFT JOIN usuarios ON nuc_id = usuarios.usr_nuc AND usr_archive = 0 ";
					$sql.= "LEFT JOIN nucleotipos ON nuc_nuct = nuct_id  ";					
					$sql.= "WHERE 1 ";
					if($nuc_archive!=-1) $sql.= " AND nuc_archive = ' " . $nuc_archive .  " ' ";
					if($nuc_nuct!=-1) $sql.= " AND nuc_nuct = ' " . $nuc_nuct .  " ' ";
					$sql.= "GROUP BY nuc_id ";
					$sql.= "ORDER BY nuc_archive, nuc_nome_completo ";
					$contador=0;
					$res = executa_sql($sql);
				    if($res)
					{
					 while ($row = mysqli_fetch_array($res,MYSQLI_ASSOC)) 
				     {
						$classe_arquivado = ($row['nuc_archive'] == 0) ? "": " class='warning'";
						$icone_arquivado = ($row['nuc_archive'] == 0) ? "": " <i class='glyphicon glyphicon-inbox'></i> ";
				?>				 
				  <tr <?php echo($classe_arquivado);?>>
                  	 <td><?php echo(++$contador); ?></td>
					 <td><?php echo($row['nuct_nome']);?></td> 
                     <td><a href="nucleo.php?action=0&amp;nuc_id=<?php echo($row['nuc_id']);?>"><?php echo($icone_arquivado);?><?php echo($row['nuc_nome_completo']);?></a></td>
                     <td><?php echo($row['nuc_nome_curto']);?></td> 
					 <td><?php echo($row['nuc_email']);?> </td>                     
					 <td>&nbsp;<?php echo($row['nuc_qtde_cestantes']);?> &nbsp; <a class="btn btn-default btn-xs" href="cestantes.php?usr_nuc=<?php echo($row['nuc_id']);?>"><i class="glyphicon glyphicon-search"></i> consultar</a></td>                     
				  </tr>
				<?php 
				     }
				   }
				?>
		</tbody>
	</table>

</div>

<span class="pull-right">
		<a href="nucleo.php?action=<?php echo(ACAO_INCLUIR);?>" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i> adicionar novo</a>
	</span>
        
<?php 
 
	footer();
?>
