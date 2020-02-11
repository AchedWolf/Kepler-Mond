<html>
<head>
	<link rel="icon" href="imagens/logomarca.png">
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>Kepler</title>
</head>
<body>
<?php

session_start();
include "conecta.php";

if ($_SESSION['tipo']==1)
{
	$login=$_GET['login'];
	$id_video=$_GET['id_video'];
	$id_astro=$_GET['id_astro'];
	$id_anuncio=$_GET['id_anuncio'];
	$excluir=$_GET['excluir'];
	
	$tempo_ban = str_replace("T"," ",$_GET['tempo_ban']);

	$tempo_ban_format1 = explode(" ",$tempo_ban);
	$data = $tempo_ban_format1[0];
	$data_format1 = explode("-",$data);
	$dia = $data_format1[2];
	$mes = $data_format1[1];
	$ano = $data_format1[0];

	$hora_final = $tempo_ban_format1[1];
	$data_final = $dia."/".$mes."/".$ano;
	$tempo_ban_final = $data_final." ".$hora_final;
	
	if(!empty($login) and $login!=$_SESSION['login'])
	{
		if($excluir=="sim")
		{
			$consulta = $db->prepare("DELETE FROM usuario where login=?");
			$consulta->bindParam(1,$login, PDO::PARAM_STR);
			$consulta->execute();
			$linha_usuario = $consulta->fetch(PDO::FETCH_ASSOC);
			echo "<meta http-equiv='refresh' content='0; url=adm-users.php'>";
		}
		else
		{
			$consulta = $db->prepare("SELECT * FROM usuario where login=?");
			$consulta->bindParam(1,$login, PDO::PARAM_STR);
			$consulta->execute();
			$linha_usuario = $consulta->fetch(PDO::FETCH_ASSOC);
			
			$consulta_den = $db->prepare("SELECT * FROM denuncias where id_denunciado=?");
			$consulta_den->bindParam(1,$login, PDO::PARAM_STR);
			$consulta_den->execute();
			$linha_den = $consulta_den->fetch(PDO::FETCH_ASSOC);
		
			if($linha_usuario['excluido'] == 'n')
			{
				$consultaa = $db->prepare("UPDATE usuario SET excluido='s',tempo_ban=? where login=?");
				$consultaa->bindParam(1,$tempo_ban_final, PDO::PARAM_STR);
				$consultaa->bindParam(2,$login, PDO::PARAM_STR);
				$consultaa->execute();
				echo "<meta http-equiv='refresh' content='0; url=adm-users.php'>";
			}
			else
			{
				
				$consultaa = $db->prepare("UPDATE usuario SET excluido='n', tempo_ban = NULL where login=?");
				$consultaa->bindParam(1,$login, PDO::PARAM_STR);
				$consultaa->execute();
				echo "<meta http-equiv='refresh' content='0; url=adm-users.php'>";
			}
		}
	}
	else if(!empty($id_video))
	{
		$consulta = $db->prepare("SELECT * FROM  videos where id_video=?");
		$consulta->bindParam(1,$id_video, PDO::PARAM_STR);
		$consulta->execute();
		
		$linha_videos = $consulta->fetch(PDO::FETCH_ASSOC);
	
		if($linha_videos['excluido'] == 'n')
		{
			$consultaa = $db->prepare("UPDATE videos SET excluido='s' where id_video=?");
			$consultaa->bindParam(1,$id_video, PDO::PARAM_INT);
			$consultaa->execute();

			echo "<meta http-equiv='refresh' content='0; url=adm-videos.php'>";
		}
		else
		{
			$consultaa = $db->prepare("UPDATE videos SET excluido='n' where id_video=?");
			$consultaa->bindParam(1,$id_video, PDO::PARAM_INT);
			$consultaa->execute();
			echo "<meta http-equiv='refresh' content='0; url=adm-videos.php'>";
		}			
	}
	else if(!empty($id_astro))
	{
		$consulta = $db->prepare("SELECT * FROM  astros where id_astro=?");
		$consulta->bindParam(1,$id_astro, PDO::PARAM_STR);
		$consulta->execute();
		$linha_astros = $consulta->fetch(PDO::FETCH_ASSOC);
	
		if($linha_astros['excluido'] == 'n')
		{
			$consultaa = $db->prepare("UPDATE astros SET excluido='s' where id_astro=?");
			$consultaa->bindParam(1,$id_astro, PDO::PARAM_INT);
			$consultaa->execute();

			echo "<meta http-equiv='refresh' content='0; url=adm-astros.php'>";
		}
		else
		{
			$consultaa = $db->prepare("UPDATE astros SET excluido='n' where id_astro=?");
			$consultaa->bindParam(1,$id_astro, PDO::PARAM_INT);
			$consultaa->execute();
			echo "<meta http-equiv='refresh' content='0; url=adm-astros.php'>";
		}			
	}
	else if(!empty($id_anuncio))
	{
		$consulta = $db->prepare("DELETE FROM anuncios where id_anuncio=?");
		$consulta->bindParam(1,$id_anuncio, PDO::PARAM_INT);
		$consulta->execute();
		echo "<meta http-equiv='refresh' content='0; url=adm-anuncios.php'>";
	}
	else 
	{
		//echo '<script language="javascript">alert("Voce nao pode se banir.")</script>';
		//echo "<meta http-equiv='refresh' content='0; url=adm-users.php?tipo=1'>";
		
		echo '<script type="text/javascript">
				swal({
				title: "Não é possível desativar a própria conta.",
				text: "",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-users.php?tipo=1");
				}
			);</script>';
	}
}
else
{
	//echo '<script language="javascript">alert(Voce nao tem acesso a esta pagina.")</script>';
	//echo "<meta http-equiv='refresh' content='0; url=index.php'>";
	
	echo '<script type="text/javascript">
				swal({
				title: "Voc\u00ea n\u00e3o tem acesso a esta p\u00e1gina!",
				text: "",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("index.php");
				}
			);</script>';
}

?>
</body>