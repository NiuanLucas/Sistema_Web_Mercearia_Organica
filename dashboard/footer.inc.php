	</div> <!-- end #mainContent -->
    
    
<!-- ***** FOOTER ***** -->

<div class="container hidden-print" align="right">
    <hr>
Sistema desenvolvido pela Rede Ecológica, <a href="https://github.com/redeecologica/pedidos" target="_blank"> software livre disponibilizado na plataforma GitHub - 2013 <img src="img/copyleft-icon.png" width="12px" height="12px"/></a> 

</div>  <br />
  
     
   
  <?php require_once("registro_visita.inc.php"); ?>
  
  
  
  </body>
</html>


<?php 
	global $res;
	global $conn_link;
	
	if (isset($res) && !is_bool($res)) 		mysqli_free_result($res);
	if (isset($conn_link) && $conn_link)	mysqli_close($conn_link);
 ?>