<?php
	require("conecta.php");
	


	function mask($val, $mask)
	{
	 $maskared = '';
	 $k = 0;
	 for($i = 0; $i<=strlen($mask)-1; $i++)
	 {
	 if($mask[$i] == '#')
	 {
	 if(isset($val[$k]))
	 $maskared .= $val[$k++];
	 }
	 else
	 {
	 if(isset($mask[$i]))
	 $maskared .= $mask[$i];
	 }
	 }
	 return $maskared;
	}
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
  </head>
  <body>  	
	<div class="container">		
		  <h2>Alunos</h2> 		
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>						
							<th width=5%><center>Id</center></th>
							<th width=10%><center>Nome</center></th>
							<th width=5%><center>CPF</center></th>
							<th width=5%><center>RG</center></th>
							<th width=5%><center>Data Nascimento</center></th>
							<th width=5%><center>Telefone</center></th>
						</tr>
					</thead>
				<?php
					$sql="SELECT * FROM aluno";
					$sql_result=pg_query($sql)or die("Erro:".pg_last_error());
					while($row=pg_fetch_array($sql_result)){							
				?>	
						 
					<tr>					
						<td width=5%><center><?php echo $row['id'];?></center></td>
						<td width=10%><center><?php echo $row['nome'];?></center></td>
						<td width=5%><center><?php echo mask($row['cpf'],'###.###.###-##');?></center></td>
						<td width=5%><center><?php echo $row['rg'];?></center></td>
						<td width=5%><center><?php echo date('d/m/Y', strtotime($row['data_nascimento']));?></center></td>						
						<td width=10%><center><?php echo $row['telefone'];?></center></td>																													
					</tr>
				<?php
					}
				?>			
				</table>			
			</div>
			<a class="btn btn-primary" href="aluno.php" role="button">Incluir</a>
			<a class="btn btn-warning" href="index.html" role="button">Voltar</a>
	</div>	
   </body>
</html>	