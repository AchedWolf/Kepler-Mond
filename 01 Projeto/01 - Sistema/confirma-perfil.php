<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
<?php
	session_start();
	include "conecta.php";
	
	//INICIO - SALVAR IMAGEM
	$img_modo = $_POST['img_modo'];
	
	if($img_modo == 'url'){
		$avatar = $_POST['imgperfil_txt'];
	}
	else if($img_modo == 'default'){
		$avatar = "imagens/perfil-default.png";
	}
	else if($img_modo == 'file'){
		$destino = './imagens/avatar_upload/' . $_SESSION['login'] . ".jpg";
		$arquivo_tmp = $_FILES['img-file']['tmp_name'];

		/*$size = getimagesize($arquivo_tmp);

		$width = 200;
		$height = 200;

		$src = imagecreatefromstring(file_get_contents($arquivo_tmp));
		$dst = imagecreatetruecolor($width, $height);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
		imagedestroy($src);
		imagepng($dst, $destino);*/ //adjust format as needed

		if(move_uploaded_file($arquivo_tmp, $destino)){
			$avatar = "imagens/avatar_upload/" . $_SESSION['login'] . ".jpg";
		}
		else{
			$avatar = $_SESSION['avatar'];
		}
		
	}
	else
	{
		$avatar = $_SESSION['avatar'];
	}
	//FIM - SALVAR IMAGEM
	
	
	
	
	$login = $_SESSION['login'];
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$cpf = $_POST['cpf'];
	$nvl_acad = $_POST['nivel'];
	$cidade3 = $_POST['cidade'];
	$estado = $_POST['estado'];
	$email = $_POST['email'];
	$link_user = $_POST['link_user'];
	
	if($_POST['sobre'] == NULL){ $sobre = "Nada Informado."; }
	else{ $sobre = $_POST['sobre']; }
	$sobre= str_replace("<", " ", $sobre);
	$sobre= str_replace(">", " ", $sobre);
	
	$consulta = $db->prepare("UPDATE usuario SET nome=?, cpf=?, nvl_acad=?, email=?, sobrenome=?, sobre=?, cidade=? ,estado = ?,link_user = ?,avatar = ?   WHERE login = ?");
	$consulta->bindParam(1,$nome, PDO::PARAM_STR);
	$consulta->bindParam(2,$cpf, PDO::PARAM_STR);
	$consulta->bindParam(3,$nvl_acad, PDO::PARAM_STR);
	$consulta->bindParam(4,$email, PDO::PARAM_STR);
	$consulta->bindParam(5,$sobrenome, PDO::PARAM_STR);
	$consulta->bindParam(6,$sobre, PDO::PARAM_STR);
	$consulta->bindParam(7,$cidade3, PDO::PARAM_STR);
	$consulta->bindParam(8,$estado, PDO::PARAM_STR);
	$consulta->bindParam(9,$link_user, PDO::PARAM_STR);
	$consulta->bindParam(10,$avatar, PDO::PARAM_STR);
	$consulta->bindParam(11,$login, PDO::PARAM_STR);
	$consulta->execute();
			
	$num_linhas = $consulta->rowCount();
	
	if($num_linhas > 0)
	{
		clearstatcache();
		$_SESSION['logado'] = 1;
		$_SESSION['email'] = $email;
		$_SESSION['nome'] = $nome;
		$_SESSION['sobrenome'] = $sobrenome;
		$_SESSION['avatar'] = $avatar;
		
		//echo "<meta http-equiv='refresh' content='0; url=perfil.php?userp=".$_SESSION['login']."'>";
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Dados alterados com sucesso.",
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
		//echo "<meta http-equiv='refresh' content='0; url=perfil-edit.php'>";
		//echo '<script language="javascript">alert("Ocorreu um erro ao editar seus dados. Tente novamente.")</script>';
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Ocorreu um erro ao editar seus dados. Tente novamente.",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#d33",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("perfil-edit.php");
				}
			);</script>';
		
		/*echo "avatar: ".$avatar."<br>";
		echo "login: ".$login."<br>";
		echo "nome: ".$nome."<br>";
		echo "sobrenome: ".$sobrenome."<br>";
		echo "cpf: ".$cpf."<br>";
		echo "nvl_acad: ".$nvl_acad."<br>";
		echo "cidade: ".$cidade."<br>";
		echo "estado: ".$estado."<br>";
		echo "email: ".$email."<br>";
		echo "sobre: ".$sobre."<br>";
		echo "link_user: ".$link_user."<br><br>";
		echo "\nPDO::errorInfo():\n";
		print_r($db->errorInfo());*/
	}
?>
</body>