<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<meta charset="utf-8">
</head>

<body>
<?php
	session_start();
	include "conecta.php";
	
	if(count($_POST['membros'])<=0)
	{
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "\u00c9 necess\u00e1rio selecionar o(s) usu\u00e1rio(s).",
				type: "warning",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				history.back();
				}
			);</script>';
		return;
	}
	
	$acao_cargo = $_POST['acao_cargo'];
	$id_inst = $_POST['id_inst'];
	
	if($acao_cargo == "kick"){
		foreach($_POST['membros'] as $membros){
			$consulta_acao = $db->prepare('DELETE FROM relacao WHERE login = ? AND id_inst = ?');
			$consulta_acao->bindParam(1,$membros, PDO::PARAM_STR);
			$consulta_acao->bindParam(2,$id_inst, PDO::PARAM_INT);
			$consulta_acao->execute();
		}
		
		$num_linhas = $consulta_acao->rowCount();
		
		if($num_linhas < 1){
			echo "<meta http-equiv='refresh' content='0; url=inst_cargos.php?i=".$id_inst."'>";
			echo '<script language="javascript">alert("Ocorreu um erro. Tente novamente mais tarde. ERRO:1")</script>';
		}
		else{
			echo "<meta http-equiv='refresh' content='0; url=inst_cargos.php?i=".$id_inst."'>";	
		}
	}
	else if($acao_cargo == "tornar_comum"){
		foreach($_POST['membros'] as $membros){
			$consulta_acao = $db->prepare("UPDATE relacao SET tipo=0 WHERE login = ? AND id_inst = ?");
			$consulta_acao->bindParam(1,$membros, PDO::PARAM_STR);
			$consulta_acao->bindParam(2,$id_inst, PDO::PARAM_INT);
			$consulta_acao->execute();
		}
		
		$num_linhas = $consulta_acao->rowCount();
		
		if($num_linhas < 1){
			echo "<meta http-equiv='refresh' content='0; url=inst_cargos.php?i=".$id_inst."'>";
			echo '<script language="javascript">alert("Ocorreu um erro. Tente novamente mais tarde. ERRO:2")</script>';
		}
		else{
			echo "<meta http-equiv='refresh' content='0; url=inst_cargos.php?i=".$id_inst."'>";	
		}
	}
	else if($acao_cargo == "tornar_mod"){
		foreach($_POST['membros'] as $membros){
			$consulta_acao = $db->prepare("UPDATE relacao SET tipo=2 WHERE login = ? AND id_inst = ?");
			$consulta_acao->bindParam(1,$membros, PDO::PARAM_STR);
			$consulta_acao->bindParam(2,$id_inst, PDO::PARAM_INT);
			$consulta_acao->execute();
		}
		
		$num_linhas = $consulta_acao->rowCount();
		
		if($num_linhas < 1){
			echo "<meta http-equiv='refresh' content='0; url=inst_cargos.php?i=".$id_inst."'>";
			echo '<script language="javascript">alert("Ocorreu um erro. Tente novamente mais tarde. ERRO:3")</script>';
		}
		else{
			echo "<meta http-equiv='refresh' content='0; url=inst_cargos.php?i=".$id_inst."'>";	
		}
	}
	else if($acao_cargo == "tornar_adm"){
		foreach($_POST['membros'] as $membros){
			$consulta_acao = $db->prepare("UPDATE relacao SET tipo=1 WHERE login = ? AND id_inst = ?");
			$consulta_acao->bindParam(1,$membros, PDO::PARAM_STR);
			$consulta_acao->bindParam(2,$id_inst, PDO::PARAM_INT);
			$consulta_acao->execute();
		}
		
		$num_linhas = $consulta_acao->rowCount();
		
		if($num_linhas < 1){
			echo "<meta http-equiv='refresh' content='0; url=inst_cargos.php?i=".$id_inst."'>";
			echo '<script language="javascript">alert("Ocorreu um erro. Tente novamente mais tarde. ERRO:4")</script>';
		}
		else{
			echo "<meta http-equiv='refresh' content='0; url=inst_cargos.php?i=".$id_inst."'>";	
		}
	}
?>
</body>