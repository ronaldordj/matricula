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
	}	
?>