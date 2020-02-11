<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
<?php session_start();

	include("conecta.php");
	$senha_atual=$_POST['senha_atual'];
	$nova_senha=$_POST['nova_senha'];
	
	if($_SESSION['logado'] == 0){
		/*echo "<script type='text/javascript'>alert('Ocorreu um erro ao alterar sua senha. \u00c9 necess \u00e1rio realizar o login antes de continuar.')</script>";
		echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>";*/
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao alterar sua senha. \u00c9 necess \u00e1rio realizar o login antes de continuar.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#3085d6",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("login.php");
				}
			);</script>';
	}
	else{
		$consulta = $db->prepare("SELECT * FROM usuario WHERE login = ? AND excluido = 'n';");
		$consulta->bindParam(1,$_SESSION['login'], PDO::PARAM_STR);
		$consulta->execute();
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas < 1){
			/*echo "<script type='text/javascript'>alert('Ocorreu um erro ao alterar sua senha. É necess\u00e1rio realizar o login antes de continuar.')</script>";
			echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>";*/
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao alterar sua senha. \u00c9 necess \u00e1rio realizar o login antes de continuar.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#3085d6",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("login.php");
				}
			);</script>';

		}
		else{
			$linha_usuario = $consulta->fetch(PDO::FETCH_ASSOC);
			if(md5($senha_atual)!=$linha_usuario['senha']){
				/*echo "<script type='text/javascript'>alert('A senha atual do usu\u00e1rio parece n\u00e3o esta correta. Tente novamente.')</script>";
				echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=perfil-senha.php'>";*/
				echo '<script type="text/javascript">
						swal({
						title: "",
						text: "A senha atual do usu\u00e1rio parece n\u00e3o esta correta. Tente novamente.",
						type: "error",
						showCancelButton: false,
						confirmButtonColor: "#3085d6",
						confirmButtonText: "Ok",
						closeOnConfirm: false,
					},
					function(){
						window.location.assign("perfil-senha.php");
						}
					);</script>';
			}
			else{
				$consulta_2 = $db->prepare('UPDATE usuario SET senha=? WHERE login=?');
				$consulta_2->bindParam(1,md5($nova_senha), PDO::PARAM_STR);						
				$consulta_2->bindParam(2,$_SESSION['login'], PDO::PARAM_STR);						
				$consulta_2->execute();
				$num_linhas_2 = $consulta_2->rowCount();
				
				if($num_linhas_2 > 0){
					//echo $_SESSION['login'];
					/*echo "<script type='text/javascript'>alert('A sua senha foi alterada com sucesso.')</script>";
					echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=perfil.php?userp=".$_SESSION['login']."'>";*/
					echo '<script type="text/javascript">
						swal({
						title: "",
						text: "A sua senha foi alterada com sucesso.",
						type: "success",
						showCancelButton: false,
						confirmButtonColor: "#3085d6",
						confirmButtonText: "Ok",
						closeOnConfirm: false,
					},
					function(){
						window.location.assign("perfil.php?userp='.$_SESSION['login'].'");
						}
					);</script>';
				}
				else{
					/*echo "<script type='text/javascript'>alert('Ocorreu um erro ao alterar sua senha. Tente novamente.')</script>";
					echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=perfil-senha.php'>";*/
					echo '<script type="text/javascript">
							swal({
							title: "",
							text: "Ocorreu um erro ao alterar sua senha. Tente novamente.",
							type: "error",
							showCancelButton: false,
							confirmButtonColor: "#3085d6",
							confirmButtonText: "Ok",
							closeOnConfirm: false,
						},
						function(){
							window.location.assign("perfil-senha.php");
							}
						);</script>';
				}
			}
		}
	}
?>
</body>