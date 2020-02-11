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
		$mensagem="";
		$sql="";$a=2;$justificativa="";
		if(ISSET($_POST['aprovada']))
		{
			$id_inst=$_POST['inst_excluir_aprovada'];
			$situacao='s';
			$sql="UPDATE instituicao SET excluido=? WHERE id_inst=?";
			$mensagem_alert="Institui\u00e7\u00e3o de Ensino Exclu\u00edda com Sucesso!";
		}
		else
		{
			$id_inst=$_POST['inst_excluir'];
			$situacao='e';
			$justificativa=$_POST['motivo'];
			$sql="UPDATE instituicao SET excluido=?, justificativa_exc=? WHERE id_inst=?";
			$mensagem_alert="Solicita\u00e7\u00e3o de Cadastro de Institui\u00e7\u00e3o N\u00e3o Aprovada!";
		}
		
		$consulta_instituicao=$db->prepare($sql);
		$consulta_instituicao->bindParam(1,$situacao,PDO::PARAM_INT);
		
		if(!ISSET($_POST['aprovada']))
		{
			$consulta_instituicao->bindParam($a,$justificativa,PDO::PARAM_STR);
			$a++;
		}
		
		$consulta_instituicao->bindParam($a,$id_inst,PDO::PARAM_INT);
		try
		{
			$consulta_instituicao->execute();
		}	
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return;
		}
		
		if(ISSET($_POST['index_instituicoes']))
		{
			$consulta_login=$db->prepare("SELECT login FROM relacao WHERE id_inst=? AND tipo=1");
			$consulta_login->bindParam(1,$id_inst,PDO::PARAM_INT);
			$consulta_login->execute();
			$linha_login = $consulta_login->fetch(PDO::FETCH_ASSOC);
			$usuario=$linha_login['login'];
			
			if($usuario==null||$usuario=="")
			{
				echo '<script type="text/javascript">
					swal({
					title: "",
					text: "'.$mensagem_alert.'",
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
			else
			{
				echo '<script type="text/javascript">
					swal({
					title: "",
					text: "'.$mensagem_alert.'",
					type: "success",
					showCancelButton: false,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Ok",
					closeOnConfirm: false,
				},
				function(){
					window.location.assign("instituicoes.php?userp='.$usuario.'");
					}
				);</script>';
				return;
				//echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=instituicoes.php?userp=".$usuario."'>";
			}
		}
		else
		{
			include "email_instituicao_excluir.php";
			echo '<script type="text/javascript">
					swal({
					title: "",
					text: "'.$mensagem_alert.'",
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
			//echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=adm-instituicoes'>";
		}
		
	}

	
?>
</body>
</html>