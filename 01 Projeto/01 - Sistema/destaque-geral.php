<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
<?php
	include "conecta.php";
	$acao = $_GET['acao'];
	$id_video = $_GET['id_video'];
	
	if($acao == "del"){
		$consulta_des = $db->prepare('UPDATE videos SET destaque = 0 WHERE destaque = 1');
		$consulta_des->execute();
		
		$num_linhas_des = $consulta_des->rowCount();
		$linha_des = $consulta_des->fetch(PDO::FETCH_ASSOC);
		
		if($num_linhas_des > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=videos.php'>";
		}
		
		else{
			//echo "<meta http-equiv='refresh' content='0; url=videos.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao remover o vídeo dos destaques. Tente novamente mais tarde.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao remover o vídeo dos destaques. Tente novamente mais tarde.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("videos.php");
				}
			);</script>';
		}
	}
	else if($acao == "add"){
		$consulta_des = $db->prepare('UPDATE videos SET destaque = 0 WHERE destaque = 1');
		$consulta_des->execute();
		
		$num_linhas_des = $consulta_des->rowCount();
		$linha_des = $consulta_des->fetch(PDO::FETCH_ASSOC);
		
			$consulta_des2 = $db->prepare('UPDATE videos SET destaque = 1 WHERE id_video = ?');
			$consulta_des2->bindParam(1, $id_video, PDO::PARAM_INT);
			$consulta_des2->execute();
			
			$num_linhas_des2 = $consulta_des2->rowCount();
			$linha_des2 = $consulta_des2->fetch(PDO::FETCH_ASSOC);
			
			if($num_linhas_des2 > 0)
			{
				echo "<meta http-equiv='refresh' content='0; url=videos.php'>";
			}
			
			else{
				//echo "<meta http-equiv='refresh' content='0; url=videos.php'>";
				//echo '<script language="javascript">alert("Ocorreu um erro ao destacar o vídeo. Tente novamente mais tarde. (2)")</script>';
				echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao destacar o vídeo. Tente novamente mais tarde.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("videos.php");
				}
			);</script>';
			}
	}
?>
</body>