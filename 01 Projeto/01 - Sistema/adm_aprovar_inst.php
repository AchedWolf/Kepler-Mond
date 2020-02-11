<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>

<body>
<?php 
	session_start();
	
	include "conecta.php";
	
	if($_SESSION['logado']!=1)
	{
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "\u00c9 necess\u00e1rio realizar o login.",
				type: "warning",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("login.php");
				}
			);</script>';
		return;
	}
	elseif($_SESSION['tipo']!=1)
	{
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "P\u00e1gina privada para usu\u00e1rios comuns",
				type: "warning",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("index.php");
				}
			);</script>';
		return;
	}
	else
	{
		$id_inst="";
		$situacao="";
		
		if(ISSET($_POST['ativar']))
		{
			$id_inst=$_POST['inst_ativar'];
			$mensagem="Institui\u00e7\u00e3o de Ensino Reativada";
		}
		else
		{
			$id_inst=$_POST['inst_aprovar'];
			$mensagem="Solicita\u00e7\u00e3o de Cadastro de Institui\u00e7\u00e3o Aprovada";
		}
	
		
		$consulta_instituicao=$db->prepare("UPDATE instituicao SET excluido='n' WHERE id_inst=?");
		$consulta_instituicao->bindParam(1,$id_inst,PDO::PARAM_INT);
		try
		{
			$consulta_instituicao->execute();
		}	
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return;
		}
		
		if(ISSET($_POST['inst_aprovar']))
		{
			include "email_instituicao_aprovar.php"; 
		}
		
		
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "'.$mensagem.' com Sucesso!",
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

	
?>
</body>
</html>