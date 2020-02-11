<?php
	include "conecta.php";
	
	$domingo = 0;
	$segunda = 0;
	$terca = 0;
	$quarta = 0;
	$quinta = 0;
	$sexta = 0;
	$sabado = 0;
	
	# Domingo
	$sql = "SELECT SUM(tempo_total) AS soma FROM registros WHERE dia_semana='Domingo'";
	$consulta = $db->prepare($sql);
	$consulta->execute();
	$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	if($linha['soma'] != NULL)
	{
		$sql2 = "SELECT COUNT(tempo_total) AS usuarios FROM registros WHERE dia_semana='Domingo'";
		$consulta2 = $db->prepare($sql2);
		$consulta2->execute();
		$linha2 = $consulta2->fetch(PDO::FETCH_ASSOC); 
		$domingo = ($linha['soma']/3600)/$linha2['usuarios'];
	}

	# Segunda
	$sql = "SELECT SUM(tempo_total) AS soma FROM registros WHERE dia_semana='Segunda'";
	$consulta = $db->prepare($sql);
	$consulta->execute();
	$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	if($linha['soma'] != NULL)
	{
		$sql2 = "SELECT COUNT(tempo_total) AS usuarios FROM registros WHERE dia_semana='Segunda'";
		$consulta2 = $db->prepare($sql2);
		$consulta2->execute();
		$linha2 = $consulta2->fetch(PDO::FETCH_ASSOC); 
		$segunda = ($linha['soma']/3600)/$linha2['usuarios'];
	}

	# Terça
	$sql = "SELECT SUM(tempo_total) AS soma FROM registros WHERE dia_semana='Terça'";
	$consulta = $db->prepare($sql);
	$consulta->execute();
	$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	if($linha['soma'] != NULL)
	{
		$sql2 = "SELECT COUNT(tempo_total) AS usuarios FROM registros WHERE dia_semana='Terça'";
		$consulta2 = $db->prepare($sql2);
		$consulta2->execute();
		$linha2 = $consulta2->fetch(PDO::FETCH_ASSOC); 
		$terca = ($linha['soma']/3600)/$linha2['usuarios'];
	}

	# Quarta
	$sql = "SELECT SUM(tempo_total) AS soma FROM registros WHERE dia_semana='Quarta'";
	$consulta = $db->prepare($sql);
	$consulta->execute();
	$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	if($linha['soma'] != NULL)
	{
		$sql2 = "SELECT COUNT(tempo_total) AS usuarios FROM registros WHERE dia_semana='Quarta'";
		$consulta2 = $db->prepare($sql2);
		$consulta2->execute();
		$linha2 = $consulta2->fetch(PDO::FETCH_ASSOC); 
		$quarta = ($linha['soma']/3600)/$linha2['usuarios'];
	}

	# Quinta
	$sql = "SELECT SUM(tempo_total) AS soma FROM registros WHERE dia_semana='Quinta'";
	$consulta = $db->prepare($sql);
	$consulta->execute();
	$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	if($linha['soma'] != NULL)
	{
		$sql2 = "SELECT COUNT(tempo_total) AS usuarios FROM registros WHERE dia_semana='Quinta'";
		$consulta2 = $db->prepare($sql2);
		$consulta2->execute();
		$linha2 = $consulta2->fetch(PDO::FETCH_ASSOC); 
		$quinta = ($linha['soma']/3600)/$linha2['usuarios'];
	}

	# Sexta
	$sql = "SELECT SUM(tempo_total) AS soma FROM registros WHERE dia_semana='Sexta'";
	$consulta = $db->prepare($sql);
	$consulta->execute();
	$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	if($linha['soma'] != NULL)
	{
		$sql2 = "SELECT COUNT(tempo_total) AS usuarios FROM registros WHERE dia_semana='Sexta'";
		$consulta2 = $db->prepare($sql2);
		$consulta2->execute();
		$linha2 = $consulta2->fetch(PDO::FETCH_ASSOC); 
		$sexta = ($linha['soma']/3600)/$linha2['usuarios'];
	}

	# Sábado
	$sql = "SELECT SUM(tempo_total) AS soma FROM registros WHERE dia_semana='Sabado'";
	$consulta = $db->prepare($sql);
	$consulta->execute();
	$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	if($linha['soma'] != NULL)
	{
		$sql2 = "SELECT COUNT(tempo_total) AS usuarios FROM registros WHERE dia_semana='Sabado'";
		$consulta2 = $db->prepare($sql2);
		$consulta2->execute();
		$linha2 = $consulta2->fetch(PDO::FETCH_ASSOC); 
		$sabado = ($linha['soma']/3600)/$linha2['usuarios'];
	}

	$domingo = round($domingo, 4);
	$segunda = round($segunda, 4);
	$terca = round($terca, 4);
	$quarta = round($quarta, 4);
	$quinta = round($quinta, 4);
	$sexta = round($sexta, 4);
	$sabado = round($sabado, 4);  

	header('Location:grafico_imagem_tempo.php?domingo='.$domingo.'&segunda='.$segunda.'&terca='.$terca.'&quarta='.$quarta.'&quinta='.$quinta.'&sexta='.$sexta.'&sabado='.$sabado.'');
?>