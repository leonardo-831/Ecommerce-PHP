<?php
//Sara Burgo Ceschin - Última alteração: 08/09
	$conecta = pg_connect("host=localhost port=5432 dbname=b25luanalima 
							user=b25luanalima password=princesalua"); 
	if (!$conecta)
	{
		echo "Não foi possível estabelecer conexão com o banco de dados!<br><br>";
		exit;
	}
?>
