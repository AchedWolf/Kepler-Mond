<?php
	include "conecta.php";

	$consulta = $db->prepare('SELECT * FROM agendamento ORDER BY id_agen');
	$consulta->execute();
	$num_linhas = $consulta->rowCount();
	
	if($num_linhas < 1)
	{ 
		echo "Ocorreu um erro ao carregar Todos os agendamentos";
	} 
	else
	{ 
		while($linha = $consulta->fetch(PDO::FETCH_OBJ))
		{ 
			if($linha->tipo_astro == 'asteroide'){ $tipo_asteroide = $tipo_asteroide+1; }
			else if($linha->tipo_astro == 'estrela'){ $tipo_estrela = $tipo_estrela+1; }
			else if($linha->tipo_astro == 'planeta'){ $tipo_planeta = $tipo_planeta+1; }
			else if($linha->tipo_astro == 'satelite'){ $tipo_satelite = $tipo_satelite+1; }
			else if($linha->tipo_astro == 'cometa'){ $tipo_cometa = $tipo_cometa+1; }
			$agendamentos = $agendamentos+1;
		} 
		$porc_asteroide = round(($tipo_asteroide*100)/$agendamentos,1);
		$porc_estrela = round(($tipo_estrela*100)/$agendamentos,1);
		$porc_planeta = round(($tipo_planeta*100)/$agendamentos,1);
		$porc_satelite = round(($tipo_satelite*100)/$agendamentos,1);
		$porc_cometa = round(($tipo_cometa*100)/$agendamentos,1);



		header('Location:grafico_imagem_todos_agendamentos.php?asteroide='.$porc_asteroide.'&estrela='.$porc_estrela.'&planeta='.$porc_planeta.'&satelite='.$porc_satelite.'&cometa='.$porc_cometa.'&tipo_asteroide='.$tipo_asteroide.'&tipo_estrela='.$tipo_estrela.'&tipo_planeta='.$tipo_planeta.'&tipo_satelite='.$tipo_satelite.'&tipo_cometa='.$tipo_cometa.'');
	}

?>