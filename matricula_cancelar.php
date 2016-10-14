<?php
  require("conecta.php");
  
  
  $id = $_GET['codigo'];    

	$sql="select * from matricula where id = $id";
	$sql_result=pg_query($sql)or die("Erro:".pg_last_error());
	$row=pg_fetch_array($sql_result);
	$pagto = $row['pago'];
	$status = $row['ativo'];
	
	if ($status == 1) {

		if($pagto == 1){
			$queryAtualizacao = "UPDATE matricula set ativo = 0, pago = 2 where ativo = 1 and id = $id";
			pg_query($queryAtualizacao) or die("Algo deu errado ao cancelar a matrícula. Tente novamente." .pg_last_error());   	
			echo "<script>alert('O pagamento foi estornado e a matrícula foi cancelada com sucesso!'),location.href='lista_matricula.php'</script>";
		exit;
		} 
		else {
		$queryAtualizacao = "UPDATE matricula set ativo = 0 where ativo = 1 and id = $id";
		pg_query($queryAtualizacao) or die("Algo deu errado ao cancelar a matrícula. Tente novamente." .pg_last_error());   	
		echo "<script>alert('Matrícula cancelada com sucesso!'),location.href='lista_matricula.php'</script>";
		}
	}
	else {
		echo "<script>alert('Esta matrícula já está cancelada!'),location.href='lista_matricula.php'</script>";
	}		
  ?>