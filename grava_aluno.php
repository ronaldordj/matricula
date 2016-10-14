<?php
  require("conecta.php");
  
  
  $id = $_POST['id'];
  $cpf = $_POST['cpf'];  
  $rg = $_POST['rg'];    
  $data = $_POST['data'];  
  $nome = $_POST['nome'];  
  $telefone = $_POST['telefone'];    
  
  $cpfsm = preg_replace("/\D+/", "", $cpf);
  $rgsm = preg_replace("/\D+/", "", $rg);
  //$datasm = preg_replace("/\D+/", "", $data);
  //$telefonesm = preg_replace("/\D+/", "", $telefone);
  
    $checa = pg_query("select * from aluno where cpf = '$cpfsm'");  	

	if(pg_num_rows($checa) >= 1){
		echo "<script>alert('Aluno j? cadastrado para este CPF, verifique.'),location.href='aluno.php'</script>";
	exit;
	} 
	else {
	$queryInsercao = "INSERT INTO aluno (id, cpf, rg, data_nascimento, nome, telefone) VALUES ($id, '$cpfsm', $rgsm, '$data', '$nome', '$telefone')";
    pg_query($queryInsercao) or die("Algo deu errado ao inserir o registro. Tente novamente." .pg_last_error());   	
	echo "<script>alert('Aluno cadastrado com sucesso!'),location.href='lista_aluno.php'</script>";
	}
  ?>