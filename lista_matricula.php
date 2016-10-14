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
		  <h2>Matrículas</h2>					
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>						
							<th width=5%><center>Id</center></th>
							<th width=10%><center>Aluno</center></th>
							<th width=5%><center>CPF</center></th>
							<th width=5%><center>Curso</center></th>
							<th width=5%><center>Período</center></th>
							<th width=5%><center>Valor curso</center></th>
							<th width=5%><center>Data Matrícula</center></th>
							<th width=5%><center>Status</center></th>
							<th width=5%><center>Pagamento</center></th>
							<th width=5%><center>Ações</center></th>
						</tr>
					</thead>						
				<?php
					$sql="select matricula.id, aluno.nome, aluno.cpf, curso.nome, curso.periodo, curso.valor_inscricao, matricula.data_matricula, matricula.ativo, matricula.pago from matricula join aluno on (aluno.id = matricula.aluno_id) join curso on (curso.id = matricula.curso_id) order by matricula.id";
					$sql_result=pg_query($sql)or die("Erro:".pg_last_error());
					while($row=pg_fetch_array($sql_result)){							
				?>	
						 
					<tr>					
						<td width=5%><center><?php echo $row[0];?></center></td>
						<td width=10%><center><?php echo $row[1];?></center></td>
						<td width=5%><center><?php echo mask($row[2],'###.###.###-##');?></center></td>
						<td width=5%><center><?php echo $row[3];?></center></td>
						<?php							
							switch ($row[4]) {
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
						<td width=5%><center><?php echo ('R$ ' . number_format($row[5], 2, ',', '.'));?></center></td>
						<td width=5%><center><?php echo date('d/m/Y', strtotime($row['data_matricula']));?></center></td>
						<?php							
							switch ($row['ativo']) {
							   case 0:
									 echo '<td width=5% class="danger"><center>Inativa</center></td>';
									 break;
							   case 1:
									 echo '<td width=5% class="success"><center>Ativa</center></td>';
									 break;			   
							}
						?>
						<?php							
							switch ($row['pago']) {
							   case 0:
									 echo '<td width=5%><center>Aberto</center></td>';
									 break;
							   case 1:
									 echo '<td width=5% class="success"><center>Realizado</center></td>';
									 break;
							   case 2:
									 echo '<td width=5% class="warning"><center>Estronado</center></td>';
									 break;		
							}
						?>
						<td width=5%><center><?php echo "<a href='receber.php?codigo=".$row[0]."'> R </a>"?><?php echo "<a href='matricula_cancelar.php?codigo=".$row[0]."'> C </a>"?></center></td>						
					</tr>
				<?php
					}
				?>			
				</table>			
			</div>
			<a class="btn btn-primary" href="matricula.php" role="button">Incluir</a>
			<a class="btn btn-warning" href="index.html" role="button">Voltar</a>
	</div>		
   </body>
</html>	