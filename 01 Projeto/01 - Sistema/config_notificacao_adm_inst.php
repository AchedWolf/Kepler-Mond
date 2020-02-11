<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<title>Alteração de Configurações de Envio de Notificações</title>
</head>

<body>
<?php 
	session_start(); 
	include("conecta.php");
	if($_SESSION['logado']!=1||$_SESSION['tipo']!=1)
	{
		  echo '<script type="text/javascript">
					swal({
					title: "",
					text: "Vo\u00ea n\u00e3o possui autoriza\u00e7\u00e3o para acessar esta p\u00e1gina.",
					type: "warning",
					showCancelButton: false,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Ok",
					closeOnConfirm: false,
				},
				function(){
					history.back()
					}
				);</script>';
		return;
	}
	
	$login=$_POST['adm_envio_notificacao'];
	
	$alteracao_adm = $db->prepare("UPDATE relacao SET login=? WHERE tipo=3");
	$alteracao_adm->bindParam(1,$login,PDO::PARAM_STR);
	
	try
	{
		$alteracao_adm->execute();
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Altera\u00e7\u00e3o realizada com sucesso!",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-instituicoes.php");
				}
			);</script>';
			return;
	}	
	catch(PDOException $e)
	{
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "N\u00e3o foi poss\u00edvel realizar a altera\u00e7\u00e3o. Tente novamente mais tarde.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-instituicoes.php");
				}
			);</script>';
			return;
		echo $e->getMessage();

	}
?>
</body>

</html>