<?php
  require("conecta.php");
  
  
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $valor = $_POST['valor'];   
  $periodo = $_POST['periodo'];      
  
  $queryInsercao = "INSERT INTO curso (id, nome, valor_inscricao, periodo) VALUES ($id, '$nome', $valor, $periodo)";
  pg_query($queryInsercao) or die("Algo deu errado ao inserir o registro. Tente novamente." .pg_last_error());   	
  echo "<script>alert('Curso cadastrado com sucesso!'),location.href='lista_curso.php'</script>";
	
  ?>