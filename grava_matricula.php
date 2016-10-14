<?php
  require("conecta.php");
  
  
  $id = $_POST['id'];  
  $data = $_POST['data'];
  $ativo = $_POST['ativo'];   
  $nome = $_POST['nome'];  
  $curso = $_POST['curso'];
  $ano = $_POST['ano']; 

	$sql="select id from aluno where nome = '$nome'";
	$sql_result=pg_query($sql)or die("Erro:".pg_last_error());
	$row=pg_fetch_array($sql_result);
	$aluno = $row['id'];
	
	$sqlC="select * from curso where id = $curso";
	$sql_resultC=pg_query($sqlC)or die("Erro:".pg_last_error());
	$rowC=pg_fetch_array($sql_resultC);
	$periodo = $rowC['periodo'];    
  
    $checa = pg_query("select * from matricula join curso on (curso.id = matricula.curso_id) where matricula.aluno_id = $aluno and matricula.ano = $ano and (curso.periodo = $periodo or curso.periodo = 3)");
	$checa_row=pg_fetch_array($checa);
	$var1=$checa_row[8];
	

	if(pg_num_rows($checa) >= 1){
		echo "<script>alert('Aluno já matriculado no curso ".$var1." no mesmo ano e/ou mesmo período!'),location.href='matricula.php'</script>";				
	exit;
	} 
	else {
	$queryInsercao = "INSERT INTO matricula (id, aluno_id, curso_id, data_matricula, ano, ativo, pago) VALUES ($id, $aluno, $curso, '$data', $ano, $ativo, 0)";
    pg_query($queryInsercao) or die("Algo deu errado ao inserir o registro. Tente novamente." .pg_last_error());   	
	echo "<script>alert('Matrícula cadastrada com sucesso!'),location.href='lista_matricula.php'</script>";
	}
  ?>