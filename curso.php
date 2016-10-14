<?php
	require("conecta.php");
?>
<!DOCTYPE html>
<html>
  <head lang="pt-br">
      <meta charset="UTF-8">
      <title>Escola</title>
	  <link href="css/bootstrap.css" rel="stylesheet">	  
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
	  <script language="JavaScript" type="text/javascript" src="js/MascaraValidacao.js"></script> 	  	  
	  
  </head>
	<body>
		<?php 
		$sql="select max(id) maior from Curso";
		$sql_result=pg_query($sql)or die("Erro:".pg_last_error());
		$row=pg_fetch_array($sql_result);
		$seq = $row['maior']+1;		
		?>
		<div class="container">
			<h2>Cadastro de Cursos</h2>
		
			<form action="grava_curso.php" method="post">
			
				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
						<label>Código</label><br>
						<input name="id" class="form-control" type="text" id="id" readonly value="<?php echo $seq ?>"/>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label>Nome do curso</label><br>
						<input name="nome" class="form-control" type="text" id="nome" maxlength="40" autofocus />
					</div>
				</div>				
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<label>Valor de inscrição</label><br>
						<div class="input-group">
							<div class="input-group-addon">R$</div>
								<input type="text" name="valor" class="form-control" id="valor" maxlength="14" />							
						</div>	
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<label>Período</label><br>						
						<select name="periodo" id="periodo" class="form-control">		
							<?php
									$sql="select * from periodo";
									$sql_result=pg_query($sql)or die("Erro:".pg_last_error()); 		 	 		 		
									
									while($row=pg_fetch_array($sql_result)){
							?>
									<option value="<?php echo $row['id'];?>"><?php echo $row['descricao'];?></option>					
							<?php		
									}								
							?>			
						</select>
					</div>					
				</div>											
				<br></br>
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-6">							
						 <button type="submit" class="btn btn-default">Salvar</button>
						 <a class="btn btn-warning" href="lista_curso.php" role="button">Voltar</a>
					</div>
				</div>
				
			</form>
		</div>	
	</body>
</html>