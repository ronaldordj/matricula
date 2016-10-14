<?php
  require("conecta.php");
  
	$id = $_GET['codigo'];    

	$sql="select matricula.id, aluno.nome, curso.nome, curso.valor_inscricao from matricula join curso on (curso.id = matricula.curso_id) join aluno on (aluno.id = matricula.aluno_id) where matricula.id = $id";
	$sql_result=pg_query($sql)or die("Erro:".pg_last_error());
	$row=pg_fetch_array($sql_result);	
	$valor = $row['valor_inscricao'];
?>
<html>
  <head lang="pt-br">
      <meta charset="UTF-8">
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap Core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">	  
      <link href="css/bootstrap.css" rel="stylesheet">	  
	  <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	  <script type="text/javascript"  src="js/jquery-1.11.1.min.js"></script>	
      <title>Escola</title>
		<script>
		
		function formatReal( int )

			{

			var tmp = int+'';

			var neg = false;

			if(tmp.indexOf("-") == 0)

			{

			neg = true;

			tmp = tmp.replace("-","");

			}

			if(tmp.length == 1) tmp = "0"+tmp

			tmp = tmp.replace(/([0-9]{2})$/g, ",$1");

			if( tmp.length > 6)

			tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

			if( tmp.length > 9)

			tmp = tmp.replace(/([0-9]{3}).([0-9]{3}),([0-9]{2}$)/g,".$1.$2,$3");

			if( tmp.length > 12)

			tmp = tmp.replace(/([0-9]{3}).([0-9]{3}).([0-9]{3}),([0-9]{2}$)/g,".$1.$2.$3,$4");

			if(tmp.indexOf(".") == 0) tmp = tmp.replace(".","");

			if(tmp.indexOf(",") == 0) tmp = tmp.replace(",","0,");

			return (neg ? '-'+tmp : tmp);

		}
		
		function operacao(){

		str = document.formulario.dinheiro.value;

		nvdinheiro = str.replace(",", "");

		d = nvdinheiro.replace(".","");



		str2 = document.formulario.somatotal.value;

		nvsomatotal = str2.replace(",", "");

		t = nvsomatotal.replace(".","")

		a = d - t;

		document.formulario.troco.value = formatReal(a);

		}
		</script>
  </head>
  <body>  	
	<div class="container">
		<h2>Recebimento</h2>
		<?php echo 'Aluno: '. $row[1] .'</br>'; ?>
		<?php echo 'Curso: '. $row[2] .'</br>'; ?>
		<form name="formulario" action="" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					<label>Valor de inscrição</label><br>
						<div class="input-group">
							<div class="input-group-addon">R$</div>
								<input type="text" name="somatotal" class="form-control" id="somatotal" value="<?php echo number_format($valor, 2, ',', '.'); ?>" maxlength="14" readonly />							
							</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					<label>Valor recebido</label><br>
						<div class="input-group">
							<div class="input-group-addon">R$</div>
								<input type="text" name="dinheiro" class="form-control" onkeyup="javascript:operacao('')" id="dinheiro-1" maxlength="14" autofocus />							
						</div>	
				</div>
			</div>	
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					<label>Troco</label><br>
						<div class="input-group">
							<div class="input-group-addon">R$</div>
								<input type="text" name="troco" class="form-control" onkeyup="javascript:operacao('')" readonly />							
						</div>	
				</div>	
			</div>					
		</form>
		<a class="btn btn-success" href="<?php echo "matricula_receber.php?codigo=".$row[0];?>" role="button">Receber</a>		
		<a class="btn btn-danger" href="lista_matricula.php" role="button">Cancelar</a>	
	</div>
  </body>
</html>  
<?php	
	/*if ($status == 1) {
	  if($pagto == 1){
			echo "<script>alert('Esta matrícula já está paga!'),location.href='lista_matricula.php'</script>";				
		exit;
		} 
		else {
			  $queryAtualizacao = "UPDATE matricula set pago = 1 where pago = 0 and id = $id";
			  pg_query($queryAtualizacao) or die("Algo deu errado ao realizar o pagamento. Tente novamente." .pg_last_error());
			  echo "<script>alert('Pagamento realizado com sucesso!'),location.href='lista_matricula.php'</script>";    
		}
	}
	else {
		echo "<script>alert('A matrícula já foi cancelada, não permitindo o pagamento.'),location.href='lista_matricula.php'</script>";
	}*/	
?>