<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
<?php 
	include "conecta.php"; 
	$entrou = 0;
	if(isset($_GET['codigo']))
	{
			$entrou = 1;
			$codigo = $_GET['codigo'];
			$email_codigo = base64_decode($codigo);
			
			$sql ="SELECT * FROM codigo_email WHERE codigo = ? AND confirma_cadastro = 'n' AND excluido = 'n';";
			$consulta = $db->prepare($sql);
			$consulta->bindParam(1,$codigo, PDO::PARAM_STR);
			$consulta->execute();
			$num_linhas = $consulta->rowCount();
			

		if($num_linhas > 0)
		{
			$sql ="UPDATE usuario SET excluido = 'n' WHERE email = ?;";
			$consulta = $db->prepare($sql);
			$consulta->bindParam(1,$email_codigo, PDO::PARAM_STR);
			$consulta->execute();

			$sql ="UPDATE codigo_email SET excluido = 's' WHERE codigo = ? AND confirma_cadastro = 'n';";
			$consulta = $db->prepare($sql);
			$consulta->bindParam(1,$codigo, PDO::PARAM_STR);
			$consulta->execute();

			$sql ="UPDATE codigo_email SET confirma_cadastro = 's' WHERE codigo = ? AND excluido = 's' AND data IS NULL;";
			$consulta = $db->prepare($sql);
			$consulta->bindParam(1,$codigo, PDO::PARAM_STR);
			$consulta->execute();
			
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Confirma\u00e7\u00e3o de cadastro realizada com sucesso!",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("login.php");
				}
			);</script>';
		}
		else{
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Seu cadastro j\u00e1 foi confirmado, voc\u00ea j\u00e1 havia realizado esse procedimento!",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("login.php");
				}
			);</script>';
		}
	}
	else if($_SESSION['logado'] == 1)
	{
		$entrou = 1;
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Seu cadastro j\u00e1 foi confirmado, voc\u00ea j\u00e1 havia realizado esse procedimento!",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("login.php");
				}
			);</script>';
	}
	else if($entrou == 0)
	{
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Voc\u00ea n\u00e1o tem permiss\u00e1o para visualizar esta p\u00e1gina!",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("login.php");
				}
			);</script>';
	}
	else{
		//echo "<meta http-equiv='refresh' content='0; url=login.php'>";
		//echo '<script language="javascript">alert("Voc\u00ea n\u00e3o tem permiss\u00e3o para visualizar esta p\u00e1gina!");</script>';
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Voc\u00ea n\u00e1o tem permiss\u00e1o para visualizar esta p\u00e1gina!",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("login.php");
				}
			);</script>';
	}
?>
</body>