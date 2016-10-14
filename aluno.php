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
	  
	  <script language="JavaScript" type="text/javascript">
		//mascara telefone
		function mascara(o,f){
			v_obj=o
			v_fun=f
			setTimeout("execmascara()",1)
		}
		function execmascara(){
			v_obj.value=v_fun(v_obj.value)
		}
		function mtel(v){
			v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
			v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
			v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
			return v;
		}
		function id( el ){
			return document.getElementById( el );
		}
		window.onload = function(){
			id('telefone').onkeyup = function(){
				mascara( this, mtel );
			}
		}	
	</script>	
  </head>
	<body>
		<?php 
		$sql="select max(id) maior from Aluno";
		$sql_result=pg_query($sql)or die("Erro:".pg_last_error());
		$row=pg_fetch_array($sql_result);
		$seq = $row['maior']+1;		
		?>
		<div class="container">
			<h2>Cadastro de Alunos</h2>
		
			<form action="grava_aluno.php" method="post">
			
				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
						<label>Código</label><br>
						<input name="id" class="form-control" type="text" id="id" placeholder="Código" readonly value="<?php echo $seq ?>"/>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<label>Nome</label><br>
						<input name="nome" class="form-control" type="text" id="nome" placeholder="Nome" maxlength="40" autofocus />
					</div>						
					<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
						<label>Data de nascimento</label><br>						
						<input type="text" name="data" class="form-control" id="data" onKeyPress="MascaraData(this);" onBlur="ValidaData(data);" maxlength="10" />						
					</div>
				</div>		
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<label>CPF</label><br>
						<input type="text" name="cpf" class="form-control" id="cpf" OnKeyPress="MascaraCPF(this);" onBlur="ValidarCPF(cpf);" maxlength="14" />						
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<label>RG</label><br>
						<input name="rg" class="form-control" type="text" id="rg" placeholder="RG" maxlength="10" />
					</div>					
				</div>							
				<div class="row">					
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
						<label>Telefone</label><br>
						<input name="telefone" class="form-control" type="tel" id="telefone" maxlength="15" />
					</div>					
				</div>
				<br></br>
				<div class="row">
					<div class="col-sm-12 col-md-6 col-lg-6">							
						 <button type="submit" class="btn btn-default">Salvar</button>
						 <a class="btn btn-warning" href="lista_aluno.php" role="button">Voltar</a>
					</div>
				</div>
				
			</form>
		</div>	
	</body>
</html>