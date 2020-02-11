<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
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
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			/*echo "<meta http-equiv='refresh' content='0; url=adm-stream.php'>";*/
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			});</script>';
			echo $stream_ytlink;
		}
	}
	
	else if($acao == 'stream_pub'){
		$consulta = $db->prepare("UPDATE livestream SET privado = 'n'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			/*echo "<meta http-equiv='refresh' content='0; url=adm-stream.php'>";*/
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			});</script>';
			echo $stream_ytlink;
		}
	}
	
	else if($acao == 'stream_priv'){
		$consulta = $db->prepare("UPDATE livestream SET privado = 's'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			/*echo "<meta http-equiv='refresh' content='0; url=adm-stream.php'>";*/
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			});</script>';
			echo $stream_ytlink;
		}
	}
	
	else if($acao == 'home_pub'){
		$consulta = $db->prepare("UPDATE paginas SET home = 'n'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'home_priv'){
		$consulta = $db->prepare("UPDATE paginas SET home = 's'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'sobre_pub'){
		$consulta = $db->prepare("UPDATE paginas SET sobre = 'n'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'sobre_priv'){
		$consulta = $db->prepare("UPDATE paginas SET sobre = 's'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'agendamento_pub'){
		$consulta = $db->prepare("UPDATE paginas SET agendamento = 'n'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'agendamento_priv'){
		$consulta = $db->prepare("UPDATE paginas SET agendamento = 's'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'ajuda_pub'){
		$consulta = $db->prepare("UPDATE paginas SET ajuda = 'n'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'ajuda_priv'){
		$consulta = $db->prepare("UPDATE paginas SET ajuda = 's'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'videos_pub'){
		$consulta = $db->prepare("UPDATE paginas SET videos = 'n'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'videos_priv'){
		$consulta = $db->prepare("UPDATE paginas SET videos = 's'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'perfil_pub'){
		$consulta = $db->prepare("UPDATE paginas SET perfil = 'n'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'perfil_priv'){
		$consulta = $db->prepare("UPDATE paginas SET perfil = 's'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'login_pub'){
		$consulta = $db->prepare("UPDATE paginas SET login = 'n'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'login_priv'){
		$consulta = $db->prepare("UPDATE paginas SET login = 's'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'cadastro_pub'){
		$consulta = $db->prepare("UPDATE paginas SET cadastro = 'n'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'cadastro_priv'){
		$consulta = $db->prepare("UPDATE paginas SET cadastro = 's'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'instituicoes_pub'){
		$consulta = $db->prepare("UPDATE paginas SET instituicoes = 'n'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'instituicoes_priv'){
		$consulta = $db->prepare("UPDATE paginas SET instituicoes = 's'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'instituicoes_pub'){
		$consulta = $db->prepare("UPDATE paginas SET instituicoes = 'n'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
	
	else if($acao == 'instituicoes_priv'){
		$consulta = $db->prepare("UPDATE paginas SET instituicoes = 's'");
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0)
		{
			echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-pgs.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao editar o campo. Tente novamente.")</script>';
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar o campo, tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-pgs.php");
				}
			);</script>';
		}
	}
?>
</body>