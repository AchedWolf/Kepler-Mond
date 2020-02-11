<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
<?php
	session_start();
	include "conecta.php";
	
	$id_inst = $_POST['id_inst'];
	
	//INICIO - SALVAR IMAGEM
	$img_modo = $_POST['img_modo'];
	
	if($img_modo == 'url'){
		$avatar_inst = $_POST['avatar_inst_txt'];
	}
	else if($img_modo == 'default'){
		$avatar_inst = "imagens/404.png";
	}
	else if($img_modo == 'file'){
		$destino = "./imagens/avatar_inst_upload/" . $id_inst . ".jpg";
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
			$avatar_inst = "imagens/avatar_inst_upload/" . $id_inst . ".jpg";
		}
		else{
			$avatar_inst = "imagens/404.png";
		}
		
	}
	else{
		$consulta_avatar = $db->prepare('SELECT * FROM instituicao WHERE id_inst = ?');
		$consulta_avatar->bindParam(1,$id_inst, PDO::PARAM_INT);
		$consulta_avatar->execute();
		
		$linha_avatar = $consulta_avatar->fetch(PDO::FETCH_ASSOC);
		
		$avatar_inst = $linha_avatar['avatar_inst'];
	}
	//FIM - SALVAR IMAGEM
	
	
	
	
	$nome_inst = $_POST['nome_inst'];
	$sobre_inst = $_POST['sobre_inst'];
	$endereco_inst = $_POST['endereco_inst'];
	$bairro_inst = $_POST['bairro_inst'];
	$cidade_inst = $_POST['cidade_inst'];
	$estado_inst = $_POST['estado_inst'];
	$telefone_inst = $_POST['telefone_inst'];
	$email_inst = $_POST['email_inst'];
	$link_inst = $_POST['link_inst'];
	
	$consulta = $db->prepare("UPDATE instituicao SET nome_inst=?, sobre_inst=?, endereco_inst=?, bairro_inst=?, cidade_inst=?, estado_inst=?, telefone_inst=? ,email_inst = ?,link_inst = ?,avatar_inst = ? WHERE id_inst = ?");
	$consulta->bindParam(1,$nome_inst, PDO::PARAM_STR);
	$consulta->bindParam(2,$sobre_inst, PDO::PARAM_STR);
	$consulta->bindParam(3,$endereco_inst, PDO::PARAM_STR);
	$consulta->bindParam(4,$bairro_inst, PDO::PARAM_STR);
	$consulta->bindParam(5,$cidade_inst, PDO::PARAM_STR);
	$consulta->bindParam(6,$estado_inst, PDO::PARAM_STR);
	$consulta->bindParam(7,$telefone_inst, PDO::PARAM_STR);
	$consulta->bindParam(8,$email_inst, PDO::PARAM_STR);
	$consulta->bindParam(9,$link_inst, PDO::PARAM_STR);
	$consulta->bindParam(10,$avatar_inst, PDO::PARAM_STR);
	$consulta->bindParam(11,$id_inst, PDO::PARAM_INT);
	$consulta->execute();
			
	$num_linhas = $consulta->rowCount();
	
	if($num_linhas > 0)
	{		
		//echo '<script language="javascript">alert("Dados editados com sucesso.")</script>';		
		//echo "<meta http-equiv='refresh' content='0; url=instituicao.php?i=".$id_inst."'>";	
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "Dados editados com sucesso.",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("instituicao.php?i='.$id_inst.'");
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
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			});</script>';
		
		echo "avatar_inst: ".$avatar_inst."<br>";
		echo "nome_inst: ".$nome_inst."<br>";
		echo "sobre_inst: ".$sobre_inst."<br>";
		echo "endereco_inst: ".$endereco_inst."<br>";
		echo "bairro_inst: ".$bairro_inst."<br>";
		echo "cidade_inst: ".$cidade_inst."<br>";
		echo "estado_inst: ".$estado_inst."<br>";
		echo "telefone_inst: ".$telefone_inst."<br>";
		echo "email_inst: ".$email_inst."<br>";
		echo "link_inst: ".$link_inst."<br><br>";
		echo "\nPDO::errorInfo():\n";
		print_r($db->errorInfo());
	}
?>
</body>