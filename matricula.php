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
	  <script type="text/javascript" src="js/jquery-1.4.2.js"></script>
	  <script type="text/javascript" src="js/MascaraValidacao.js"></script>
	  <script type='text/javascript' src="js/jquery.autocomplete.js"></script>	  
      <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />	  
	  
	  <script type="text/javascript">
            $().ready(function() {
                $("#nome").autocomplete("autoComplete.php", {
                    width: 500,
                    matchContains: true,                    
                    selectFirst: false
                });
            });
       </script>	  
  </head>
	<body>
		<?php 
		$sql="select max(id) maior from Matricula";
		$sql_result=pg_query($sql)or die("Erro:".pg_last_error());
		$row=pg_fetch_array($sql_result);
		$seq = $row['maior']+1;		
		?>
		<div class="container">
			<h2>Processo de Inscrição/Matrícula</h2>
		
			<form method="post" action="grava_matricula.php">
			
				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
						<label>Código</label><br>
						<input name="id" class="form-control" type="text" id="id" placeholder="Código" readonly value="<?php echo $seq ?>"/>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
						<label>Data</label><br>						
						<input type="text" name="data" class="form-control" id="data" onKeyPress="MascaraData(this);" onBlur="ValidaData(data);" maxlength="10" />						
					</div>
					<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
						<div class="checkbox">
						  <label>
							<input name="ativo" type="checkbox" value="1" checked>
							Ativo
						  </label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label>Aluno</label><br>
						<input type="text" name="nome" class="form-control" id="nome" maxlength="40" />
						<div id="conteudo"> 
						</div>
					</div>					
				</div>		
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<label>Curso</label><br>
						<select name="curso" id="curso" class="form-control">		
							<?php
									$sql="select * from curso order by nome";
									$sql_result=pg_query($sql)or die("Erro:".pg_last_error()); 		 	 		 		
									
									while($row=pg_fetch_array($sql_result)){
							?>
									<option value="<?php echo $row['id'];?>"><?php echo $row['nome'];?></option>					
							<?php		
									}								
							?>			
						</select>						
					</div>
					<div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
						<label>Ano</label><br>
						<input name="ano" class="form-control" type="text" id="ano" maxlength="4" />
					</div>					
				</div>											
				<br></br>
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-6">							
						 <button type="submit" class="btn btn-default">Salvar</button>
						 <a class="btn btn-warning" href="lista_matricula.php" role="button">Voltar</a>
					</div>
				</div>
				
			</form>
		</div>	
	</body>
</html>