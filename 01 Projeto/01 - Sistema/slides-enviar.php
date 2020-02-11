<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>

<body>
<?php
	session_start();
	include "conecta.php";
	
	$link_slide = $_POST['link_slide'];
	$descr_slide = ucfirst($_POST['descr_slide']); //ucfirst deixa primeira letra maiuscula.
	$id_slide = $_POST['id_slide'];
	
	
	$destino = "./imagens/slides_index/slides" . $id_slide . ".jpg";
	$arquivo_tmp = $_FILES['img_slide']['tmp_name'];
	unlink("imagens/slides_index/slides".$id_slide.".jpg");
	
	if(move_uploaded_file($arquivo_tmp, $destino)){
		$imagem_slide = "imagens/slides_index/slides" . $id_slide . ".jpg"; //ex: nome da imagem slides1.jpg na pasta slides_index.
	}
	else{
		$imagem_slide = "";
	}
	
	//Deleta a linha que tem id maior que 3.
	$consulta_delseq3 = $db->prepare('DELETE FROM slides_index WHERE id_slide > 3');
	$consulta_delseq3->execute();
	
	//Deleta a linha com esse mesmo id_slide.
	$consulta_delseqid = $db->prepare('DELETE FROM slides_index WHERE id_slide = ?');
	$consulta_delseqid->bindParam(1,$id_slide, PDO::PARAM_INT);
	$consulta_delseqid->execute();
	
	
	//Inserir slide.	
	$consulta = $db->prepare('INSERT INTO slides_index VALUES(?, ?, ?, ?);');
	$consulta->bindParam(1,$id_slide, PDO::PARAM_INT);
	$consulta->bindParam(2,$imagem_slide, PDO::PARAM_STR);
	$consulta->bindParam(3,$descr_slide, PDO::PARAM_STR);
	$consulta->bindParam(4,$link_slide, PDO::PARAM_STR);
	$consulta->execute();
	
	$num_linhas = $consulta->rowCount();
	
	if($num_linhas > 0){
		//$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		//echo "<meta http-equiv='refresh' content='0; url=adm-slides.php'>";
		//echo '<script language="javascript">alert("O slide foi alterado com sucesso.")</script>';	
		echo '<script type="text/javascript">
				swal({
				title: "",
				text: "O slide foi alterado com sucesso",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-slides.php");
				}
			);</script>';
	}
	else{
		//echo "<meta http-equiv='refresh' content='0; url=adm-slides.php'>";
		echo "id_slide: ".$id_slide."<br>";
		echo "descr_slide: ".$descr_slide."<br>";
		echo "link_slide: ".$link_slide."<br><hr>";
		echo "arquivo_tmp: ".$arquivo_tmp."<br>";
		echo "imagem_slide: ".$imagem_slide."<br>";
		echo "destino: ".$destino."<br>";
		echo "files error: ".$_FILES['error']."<br>";
		echo "files tmp_name: ".$_FILES['img_slide']['tmp_name']."<br>";
		//echo '<script language="javascript">alert("Ocorreu um erro ao alterar o slide. Tente novamente mais tarde. ERRO:1")</script>';
		echo '<script type = "text/javascript">
				swal({
						title: "",
						text: "Ocorreu um erro ao alterar o slide. Tente novamente mais tarde. ERRO:1",
						type: "error",
						showCancelButton: false,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Ok",
						closeOnConfirm: false,
						});
				</script>';
	}
?>
</body>