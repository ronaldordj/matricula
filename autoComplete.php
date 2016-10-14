<?php
	$con=pg_connect ("host=localhost dbname=escola port=5432 user=postgres password=''");

	$q = $_GET['q'];
	if (!$q) return;

	$sql = "select nome from aluno where nome iLIKE '%$q%'";
	$rsd = pg_query($sql);
	while($rs = pg_fetch_array($rsd)) {
		$cname = $rs['nome'];
		echo "$cname\n";
	}
?>