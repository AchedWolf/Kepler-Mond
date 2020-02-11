<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8"/>
	<title>Conexão com o Banco de Dados</title>
</head>
<body>
	<?php 
	
		$conecta=pg_connect("host=200.145.153.172 port=5432 dbname=telescopio user=kepler password=73aKepler!@cti");
		
		if(!$conecta)
		{
			//echo "Não foi possível estabelecer conexão com o Banco de Dados";
			exit;
		}
		else
		{
			//echo "Conexão estabelecida com o Banco de Dados";
		}
	
	?>
</body>
</html>
