<?php
	session_start();
?>
<html lang="pt-br">
<head>
	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<title>Kepler</title>
</head>

<body>
	<?php
		include "conecta.php";
		
		$titulo01 = ucfirst($_POST['titulo']); //ucfirst deixa a primeira letra da string maiúscula.
		$desc01 = nl2br(ucfirst($_POST['desc'])); //nl2br permite pular linha.
		$login = $_SESSION['login'];
		$date = date("d/m/Y H:i");
		
		//Substituições na descrição.
		$titulo02 = str_replace("<","",$titulo01);
		$titulo = str_replace(">","",$titulo02);
		$desc04 = str_replace("[img]","<img style='max-height: 400px;max-width:100%' src='",$desc01);
		$desc = str_replace("[/img]","'></img>",$desc04);
		
		if($titulo != NULL && $desc != NULL && $login != NULL && $date != NULL)
		{
			//Publicar novo anúncio.
			
			$consulta = $db->prepare('INSERT INTO anuncios VALUES(nextval(\'seq_anuncios\'::regclass), ?, ?, ?, ?);');
			$consulta->bindParam(1,$date, PDO::PARAM_STR);
			$consulta->bindParam(2,$login, PDO::PARAM_STR);
			$consulta->bindParam(3,$titulo, PDO::PARAM_STR);
			$consulta->bindParam(4,$desc, PDO::PARAM_STR);
			$consulta->execute();
			
			$num_linhas = $consulta->rowCount();
			
			if($num_linhas > 0)
			{
				//$linha = $consulta->fetch(PDO::FETCH_ASSOC);
				//echo "<meta http-equiv='refresh' content='0; url=index.php'>";
				//echo '<script language="javascript">alert("O anúncio foi publicado com sucesso.")</script>';	
				
					echo '<script type="text/javascript">
						swal({
							title: "",
							text: "O an\u00fancio foi publicado com sucesso.",
							type: "success",
							showCancelButton: false,
							confirmButtonColor: "#3085d6",
							confirmButtonText: "Ok",
							closeOnConfirm: false,
						},
						function(){
							window.location.assign("index.php");
							}
						);</script>';	
				
							
			}
			else{
				//echo "<meta http-equiv='refresh' content='0; url=index.php?titulo=".$_POST['titulo']."&desc=".$_POST['desc']."'>";
				//echo '<script language="javascript">alert("Ocorreu um erro ao publicar o anúncio. Tente novamente mais tarde.")</script>';
				
				
						echo '<script type="text/javascript">
						swal({
							title: "",
							text: "Ocorreu um erro ao publicar o anúncio, tente novamente mais tarde.",
							type: "error",
							showCancelButton: false,
							confirmButtonColor: "#3085d6",
							confirmButtonText: "Ok",
							closeOnConfirm: false,
						},
						function(){
							window.location.assign("index.php?titulo='.$_POST['titulo'].'&desc='.$_POST['desc'].'");
							}
						);</script>';
			
			
			}
		}
		
		else{
			//echo "<meta http-equiv='refresh' content='0; url=index.php?titulo=".$_POST['titulo']."&desc=".$_POST['desc']."'>";
			//echo '<script language="javascript">alert("Ocorreu um erro ao publicar o anúncio. Tente novamente mais tarde.")</script>';
		
				echo '<script type="text/javascript">
						swal({
							title: "",
							text: "Ocorreu um erro ao publicar o anúncio, tente novamente mais tarde.",
							type: "error",
							showCancelButton: false,
							confirmButtonColor: "#3085d6",
							confirmButtonText: "Ok",
							closeOnConfirm: false,
						},
						function(){
							window.location.assign("index.php?titulo='.$_POST['titulo'].'&desc='.$_POST['desc'].'");
							}
						);</script>';
		}
	?>
</body>
</html>