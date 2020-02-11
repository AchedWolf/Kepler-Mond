<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
<?php
	session_start();
	include "conecta.php";

	$tabela = $_POST['tabela'];
	
	if($tabela == "usuario"){
		$login = $_POST['login']; //chave primária.
		$nome = $_POST['nome'];
		$sobrenome = $_POST['sobrenome'];
		$cpf = $_POST['cpf'];
		$data = $_POST['data'];
		$email = $_POST['email'];
		$cidade = $_POST['cidade'];
		//$estado = $_POST['estado'];
		$nvl_acad = $_POST['nvl_acad'];
		
		$tipo = 0;
		
		$excluido = $_POST['excluido'];
		
		$consulta = $db->prepare("SELECT * FROM usuario WHERE login LIKE ? AND nome LIKE ? AND sobrenome LIKE ? AND (cpf LIKE ? OR cpf = NULL) AND data_nasc LIKE ? AND email LIKE ? AND (cidade LIKE ? OR cidade = NULL) AND (nvl_acad LIKE ? OR nvl_acad = NULL) AND tipo = ? AND excluido LIKE ?");
		
		$consulta->bindParam(1,'%'.$login.'%', PDO::PARAM_STR);
		$consulta->bindParam(2,'%'.$nome.'%', PDO::PARAM_STR);
		$consulta->bindParam(3,'%'.$sobrenome.'%', PDO::PARAM_STR);
		$consulta->bindParam(4,'%'.$cpf.'%', PDO::PARAM_STR);
		$consulta->bindParam(5,'%'.$data.'%', PDO::PARAM_STR);
		$consulta->bindParam(6,'%'.$email.'%', PDO::PARAM_STR);
		$consulta->bindParam(7,'%'.$cidade.'%', PDO::PARAM_STR);
		$consulta->bindParam(8,'%'.$nvl_acad.'%', PDO::PARAM_STR);
		$consulta->bindParam(9,$tipo, PDO::PARAM_INT);
		$consulta->bindParam(10,'%'.$excluido.'%', PDO::PARAM_STR);
		$consulta->execute();
		
		$num_linhas = $consulta->rowCount();
		
		if($num_linhas > 0){
			echo "<meta http-equiv='refresh' content='0; url=adm-users.php'>";			
		}
		else{
			//echo "<meta http-equiv='refresh' content='0; url=adm-users.php'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao realizar a pesquisa. Tente novamente.")</script>';
			
			echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao realizar a pesquisa, tente novamente..",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-users.php");
				}
			);</script>';
		}
	}
	
	/*
	else if($tabela == "videos"){
		
	}
	
	else if($tabela == "anuncios"){
		
	}
	
	else if($tabela == ""){
		
	}
	*/
?>
</body>