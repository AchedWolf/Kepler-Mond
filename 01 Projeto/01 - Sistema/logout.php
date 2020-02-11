<?php
	session_start();
	include "conecta.php";
	
	$consulta_online = $db->prepare("UPDATE usuario SET online = 'n' WHERE login = ?");
	$consulta_online->bindParam(1,$_SESSION['login'], PDO::PARAM_STR);
	$consulta_online->execute();

	$login = $_SESSION['login'];
	
	$_SESSION['logado'] = 0;
	$_SESSION['login'] = null;
	$_SESSION['tipo'] = null;
	$_SESSION['email'] = null;
	$_SESSION['nome'] = null;
	$_SESSION['sobrenome'] = null;
	$_SESSION['avatar'] = null;
	$_SESSION['user_recebe'] = null;
	$_SESSION['chat_status'] = null;
	
	$sqll ="SELECT segundos FROM registros WHERE login = ? AND excluido = 'n'";
	$consulta = $db->prepare($sqll);
	$consulta->bindParam(1, $login, PDO::PARAM_STR);
	$consulta->execute();
	$linha = $consulta->rowCount();
	$resultado = $consulta->fetch(PDO::FETCH_OBJ);

	if($linha > 0)
	{
		$entrou = $resultado->segundos; 

		date_default_timezone_set("America/Sao_Paulo");
		$horario = date('H:i:s');		
		$str_time = $horario;
		sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
		$saiu=isset($seconds) ? $hours * 3600 + $minutes * 60 + $seconds : $hours * 60 + $minutes;

		if($entrou > $saiu)
		{
			$tempo_total = $saiu + (86399 - $entrou);
		}
		elseif($entrou == 0)
		{
			$tempo_total = $saiu;
		}
		elseif($_SESSION['pagina'] == 1 AND $_SESSION['desconectar_forcado'] == 's')
		{
			$tempo_total = 300;
		}
		elseif($_SESSION['tempo_uso'] != null AND $_SESSION['tempo_uso'] != 0 
			AND $_SESSION['desconectar_forcado'] == 's')
		{
			$tempo_total = $_SESSION['tempo_uso'] - $entrou;
		}
		else
		{
			$tempo_total = $saiu - $entrou;
		}

		$sqll ="UPDATE registros SET tempo_total = ?, excluido  = 's' WHERE login = ? AND excluido = 'n'";
		$altera = $db->prepare($sqll);
		$altera->bindParam(1, $tempo_total, PDO::PARAM_STR);
		$altera->bindParam(2, $login, PDO::PARAM_STR);
		$altera->execute();
		unset($_SESSION['tempo_uso']);
		unset($_SESSION['pagina']);
		unset($_SESSION['desconectar_forcado']);
		unset($_SESSION['desconectar_usuario']);
	}
	
	echo "<meta http-equiv='refresh' content='0; url=index.php'>";
?>