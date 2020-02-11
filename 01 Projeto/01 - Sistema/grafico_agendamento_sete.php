<?php
	include "conecta.php";

	$consulta_agen7d = $db->prepare("SELECT * FROM agendamento where (to_date(data_agen,'yyyy-mm-dd') > to_date(to_char(now(),'yyyy-mm-dd'),'yyyy-mm-dd') - 7) ORDER BY id_agen");
			$consulta_agen7d->execute();
			
			$num_linhas_agen7d = $consulta_agen7d->rowCount();
			
			if($num_linhas_agen7d < 1)
			{ 
				echo "Ocorreu um erro ao carregar Últimos 7 dias";
			 } 
			else
			{ 
				
				while($linha_agen7d = $consulta_agen7d->fetch(PDO::FETCH_OBJ))
				{ 
					if($linha_agen7d->tipo_astro == 'asteroide'){ $tipo_asteroide = $tipo_asteroide+1; }
					else if($linha_agen7d->tipo_astro == 'estrela'){ $tipo_estrela = $tipo_estrela+1; }
					else if($linha_agen7d->tipo_astro == 'planeta'){ $tipo_planeta = $tipo_planeta+1; }
					else if($linha_agen7d->tipo_astro == 'satelite'){ $tipo_satelite = $tipo_satelite+1; }
					else if($linha_agen7d->tipo_astro == 'cometa'){ $tipo_cometa = $tipo_cometa+1; }
					
					$agendamentos_agen7d = $agendamentos_agen7d+1;
				} 
				
				$porc_asteroide = round(($tipo_asteroide*100)/$agendamentos_agen7d,1);
				$porc_estrela = round(($tipo_estrela*100)/$agendamentos_agen7d,1);
				$porc_planeta = round(($tipo_planeta*100)/$agendamentos_agen7d,1);
				$porc_satelite = round(($tipo_satelite*100)/$agendamentos_agen7d,1);
				$porc_cometa = round(($tipo_cometa*100)/$agendamentos_agen7d,1);

				header('Location:grafico_imagem_agendamento_sete.php?asteroide='.$porc_asteroide.'&estrela='.$porc_estrela.'&planeta='.$porc_planeta.'&satelite='.$porc_satelite.'&cometa='.$porc_cometa.'&tipo_asteroide='.$tipo_asteroide.'&tipo_estrela='.$tipo_estrela.'&tipo_planeta='.$tipo_planeta.'&tipo_satelite='.$tipo_satelite.'&tipo_cometa='.$tipo_cometa.'');
			}	
?>