

<!-- Rodapé - INICIO -->
	<div id="rodape">
		<b><div id="icon-img" style="background-image: url('imagens/mapa.png');height:20px;"></div>Mapa do Site</b><br>
		<div id="rod-col">
			<a href="index.php" id="link1">Home</a><br>
			<a href="agendamento.php" id="link2">Agendamento</a><br>
			<a href="sobre-geral.php" id="link3">Sobre</a><br>
		</div>
		<div id="rod-col">
			<a href="ajuda.php" id="link4">Ajuda</a><br>
			<a href="videos.php" id="link5">Vídeos</a><br>
			<a href="comunidade.php" id="link6">Comunidade</a><br>
		</div>
		<br><br><br><br>
		<a href="https://www.facebook.com/projeto.kepler/"><div id="rod-social" style="background-image: url('imagens/facebook.png');" title="Facebook"></div></a>
		<a href="https://twitter.com/kepler_cti"><div id="rod-social" style="background-image: url('imagens/twitter.png');" title="Twitter"></div></a>
		<a href="https://www.youtube.com/channel/UCwzV55c_KN-hMauYrdPqlEA"><div id="rod-social" style="background-image: url('imagens/youtube.png');" title="YouTube"></div></a>
	</div>
<?php
	if($_SESSION['logado'] == 1)
	{
		$sqll ="SELECT tempo_total, segundos FROM registros WHERE login = ? AND excluido = 'n'";
		$consulta = $db->prepare($sqll);
		$consulta->bindParam(1, $_SESSION['login'], PDO::PARAM_STR);
		$consulta->execute();
		$linha = $consulta->rowCount();
		$resultado = $consulta->fetch(PDO::FETCH_OBJ);
		if($linha > 0)
		{
			$tempo_final = $resultado->tempo_total;
			if($tempo_final > 0)
			{
				$segundos = $resultado->segundos;
				$tempo_final = $_SESSION['tempo_uso'] - $segundos;
				$sqll="UPDATE registros SET tempo_total = ? WHERE login = ? AND excluido = 'n'";
				$altera = $db->prepare($sqll);
				$altera->bindParam(1, $tempo_final, PDO::PARAM_STR);
				$altera->bindParam(2, $_SESSION['login'], PDO::PARAM_STR);
				$altera->execute();
			}
			else
			{
				$sqll="UPDATE registros SET tempo_total = 300 WHERE login = ? AND excluido = 'n'";
				$altera = $db->prepare($sqll);
				$altera->bindParam(1, $_SESSION['login'], PDO::PARAM_STR);
				$altera->execute();
			}
		}
		else
		{
			$sqll ="UPDATE registros SET tempo_total = 300 WHERE login = ? AND excluido = 'n'";
			$altera = $db->prepare($sqll);
			$altera->bindParam(1, $_SESSION['login'], PDO::PARAM_STR);
			$altera->execute();
		}	
	}
	
?>
<!-- Rodapé - FIM -->