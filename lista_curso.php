<?php
	require("conecta.php");
?>

<!DOCTYPE html>
<html>
  <head lang="pt-br">
      <meta charset="UTF-8">
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">	  
      <link href="css/bootstrap.css" rel="stylesheet">	  
	  <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
      <title>Escola</title>	 
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="images/favicon.ico" type="image/x-icon">	
  </head>
  <body>  	
	<div class="container">		
		  <h2>Cursos</h2> 
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>						
							<th width=5%><center>Id</center></th>
							<th width=10%><center>Nome do curso</center></th>
							<th width=5%><center>Período</center></th>
							<th width=5%><center>Valor da Inscrição</center></th>							
						</tr>
					</thead>
				<?php
					$sql="SELECT * FROM curso";
					$sql_result=pg_query($sql)or die("Erro:".pg_last_error());
					while($row=pg_fetch_array($sql_result)){							
				?>	
						 
					<tr>					
						<td width=5%><center><?php echo $row['id'];?></center></td>
						<td width=10%><center><?php echo $row['nome'];?></center></td>
						<?php							
							switch ($row['periodo']) {
							   case 1:
									 echo '<td width=5%><center>Matutino</center></td>';
									 break;
							   case 2:
									 echo '<td width=5%><center>Vespertino</center></td>';
									 break;
							   case 3:
									 echo '<td width=5%><center>Integral</center></td>';
									 break;		
							}
						?>							
						<td width=5%><center><?php echo ('R$ ' . number_format($row['valor_inscricao'], 2, ',', '.'));?></center></td>	
					</tr>
				<?php
					}
				?>			
				</table>			
			</div>
			<a class="btn btn-primary" href="curso.php" role="button">Incluir</a>
			<a class="btn btn-warning" href="index.html" role="button">Voltar</a>
	</div>	
   </body>
</html>	