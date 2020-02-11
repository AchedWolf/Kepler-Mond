<?php
	session_start();
	include "conecta.php";
	
	$acao = $_POST['acao'];
	
	if($acao == 'stream_url'){
		$stream_ytlink = $_POST[stream_ytlink];
		
		$consulta = $db->prepare("UPDATE livestream SET stream_ytlink = ?");
		$consulta->bindParam(1,$stream_ytlink, PDO::PARAM_STR);
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-stream.php'>";				
		}
		else{
			/*echo "<meta http-equiv='refresh' content='0; url=adm-stream.php'>";*/
			echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo $stream_ytlink;
		}
	}
	
	else if($acao == 'stream_pub'){
		$consulta = $db->prepare("UPDATE livestream SET privado = 'n'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-stream.php'>";				
		}
		else{
			/*echo "<meta http-equiv='refresh' content='0; url=adm-stream.php'>";*/
			echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo $stream_ytlink;
		}
	}
	
	else if($acao == 'stream_priv'){
		$consulta = $db->prepare("UPDATE livestream SET privado = 's'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-stream.php'>";				
		}
		else{
			/*echo "<meta http-equiv='refresh' content='0; url=adm-stream.php'>";*/
			echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo $stream_ytlink;
		}
	}
?>