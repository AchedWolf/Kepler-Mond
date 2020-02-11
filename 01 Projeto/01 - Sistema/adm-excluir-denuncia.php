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
		echo "Não é possível acessar essa página.";
	}
	elseif($_SESSION['tipo']!=1)
	{
		echo "Necessário autorização para acessar essa página.";
	}
	else
	{
		$id_inst="";
		$id_inst=$_POST['inst_excluir'];
		
		$excluir_denuncia=$db->prepare("DELETE FROM denuncias WHERE id_den=?");
		$excluir_denuncia->bindParam(1,$id_inst,PDO::PARAM_INT);
		
		try
		{
			$excluir_denuncia->execute();
		}	
		catch(PDOException $e)
		{
			echo $e->getMessage();
			return;
		}
		
		//echo "<script type='text/javascript'>alert('Denúncia Excluída com Sucesso!')</script>";
		//echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=adm-inst-denuncias.php'>";
		
		echo '<script type="text/javascript">
			  swal({
			  title: "",
			  text: "Den\u00fancia Exclu\u00edda com Sucesso!",
			  type: "success",
			  showCancelButton: false,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Ok",
			  closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-inst-denuncias.php");
				}
			);</script>';
		return;
	}
	
?>
</body>
</html>