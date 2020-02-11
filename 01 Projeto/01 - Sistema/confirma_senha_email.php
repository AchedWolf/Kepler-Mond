<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
	<?php
		session_start();
		include("conecta.php");

		$nova_senha = $_POST['nova_senha'];

		$sql = "UPDATE usuario SET senha = ? WHERE email = ?";
		$consulta = $db->prepare($sql);
		$consulta->bindParam(1,md5($nova_senha), PDO::PARAM_STR);						
		$consulta->bindParam(2,$_SESSION['email'], PDO::PARAM_STR);
		$consulta->execute();
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0){
			//modificar o banco codigo email aqui
			$sql = "UPDATE codigo_email SET excluido = 's' WHERE codigo = ? AND id = ?";
			$consulta = $db->prepare($sql);
			$consulta->bindParam(1,$_SESSION['codigo'], PDO::PARAM_STR);
			$consulta->bindParam(2,$_SESSION['id'], PDO::PARAM_STR);
			$consulta->execute();

			/*echo "<script type='text/javascript'>alert('A sua senha foi alterada com sucesso.')</script>";
			echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>";
			*/
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
					window.location.assign("login.php");
					}
				);</script>';
		}
		else{
			/*echo "<script type='text/javascript'>alert('Ocorreu um erro ao alterar sua senha. Tente novamente.')</script>";
			echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=confirma_senha_email.php'>";
			*/
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
					window.location.assign("confirma_senha_email.php");
					}
				);</script>';
		}
		

	?>
</body>