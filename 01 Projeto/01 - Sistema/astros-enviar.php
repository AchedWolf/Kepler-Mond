<?php session_start(); ?> <html>
<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
	<link href='css/estilo23.css' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>Kepler</title>
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php"; ?>
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;"><div id="cont-esquerda" style="margin-left:0px;">
		
			
			
		</div>
		<!--Menu da Esquerda - FIM -->
			
		<!--Menu do Centro - INICIO -->
		<div id="cont-direita">
			<?php

session_start();

if($_SESSION['logado'] == 1)
{
	$nome = $_POST['nome_up'];
	if(!empty($nome))
	{
		$tipo = $_POST['tipo4'];
		$img_modo = $_POST['img_modo'];
		$id = $_POST['id_up'];
		$num_agen = $_POST['num_up'];
		$raio = $_POST['raio_up'];
		$descr = $_POST['descr_up'];
		$fonte = $_POST['fonte_up'];
		$reserva = $_POST['img_carrega'];
		
		if($img_modo == 'url'){
			$img = $_POST['imgperfil_txt'];
		}
		else if($img_modo == 'default'){
			$img = "imagens/404.png";
		}
		else if($img_modo == 'file')
		{
			$destino = './imagens/'.$tipo.'/' . $nome . ".jpg";	
			$arquivo_tmp = $_FILES['img-file']['tmp_name'];
		

			if(move_uploaded_file($arquivo_tmp, $destino))
			{
				$img = "imagens/".$tipo."/" . $nome . ".jpg";
			
			}
		}
		else if(!empty($reserva))
		{
			$img = $reserva;
		}
		else
		{
			$img = "imagens/404.png";
		}
			
			
			include "conecta.php";
			$consulta = $db->prepare('UPDATE astros SET nome=?,descr=?,img=?,num_agen=?,raio=?,fonte=?,tipo=? WHERE id_astro=?');
			$consulta->bindParam(1,$nome, PDO::PARAM_STR);
			$consulta->bindParam(2,$descr, PDO::PARAM_STR);
			$consulta->bindParam(3,$img, PDO::PARAM_STR);
			$consulta->bindParam(4,$num_agen, PDO::PARAM_INT);
			$consulta->bindParam(5,$raio, PDO::PARAM_INT);
			$consulta->bindParam(6,$fonte, PDO::PARAM_STR);
			$consulta->bindParam(7,$tipo, PDO::PARAM_INT);
			$consulta->bindParam(8,$id, PDO::PARAM_INT);
			$consulta->execute();
			
			echo '<script type="text/javascript">
				swal({
				title: "Astro salvo com sucesso!",
				text: "",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-astros.php");
				}
			);</script>';
			//echo "<meta http-equiv='refresh' content='0; url=adm-astros.php'>";
			
	}
	else
	{
		$nome = $_POST['nome'];
		$tipo = $_POST['tipo4'];
		$img_modo = $_POST['img_modo'];
		$nome = $_POST['nome'];
		$id = $_POST['id'];
		$num_agen = $_POST['num'];
		$raio = $_POST['raio'];
		$descr = $_POST['descr'];
		$fonte = $_POST['fonte'];
		
		if($img_modo == 'url'){
			$img = $_POST['imgperfil_txt'];
		}
		else if($img_modo == 'default'){
			$img = "imagens/404.png";
		}
		else if($img_modo == 'file')
		{
			$destino = './imagens/'.$tipo.'/' . $nome . ".jpg";	
			echo $destino;
			$arquivo_tmp = $_FILES['img-file']['tmp_name'];

			if(move_uploaded_file($arquivo_tmp, $destino))
			{
				$img = "imagens/".$tipo."/" . $nome . ".jpg";
			
			}
		}
		else if(!empty($reserva))
		{
			$img = $reserva;
		}
		else
		{
			$img = "imagens/404.png";
		}
			include "conecta.php";
			$consulta = $db->prepare('INSERT into astros VALUES (default,?,?,?,?,?,?,?,default)');
			$consulta->bindParam(1,$nome, PDO::PARAM_STR);
			$consulta->bindParam(2,$descr, PDO::PARAM_STR);
			$consulta->bindParam(3,$img, PDO::PARAM_STR);
			$consulta->bindParam(4,$num_agen, PDO::PARAM_INT);
			$consulta->bindParam(5,$raio, PDO::PARAM_INT);
			$consulta->bindParam(6,$fonte, PDO::PARAM_STR);
			$consulta->bindParam(7,$tipo, PDO::PARAM_INT);
			$consulta->execute();
			
			echo '<script type="text/javascript">
				swal({
				title: "Astro salvo com sucesso!",
				text: "",
				type: "success",
				showCancelButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ok",
				closeOnConfirm: false,
			},
			function(){
				window.location.assign("adm-astros.php");
				}
			);</script>';
								
		//	echo "<meta http-equiv='refresh' content='0; url=adm-astros.php'>";
			
	}
}
?>
		</div>
		<!--Menu do Centro - FIM -->
	
	<!-- TOPO - INICIO -->
		<a onclick="scrollToTop(400);" style="display:block;">
			<div id="voltaraotopo" title="Voltar ao Topo">
				<img src="imagens/topo.png" height="50px" class="floating">
			</div>
		</a>
		<script>
		function scrollToTop(scrollDuration) {
		const   scrollHeight = window.scrollY,
		        scrollStep = Math.PI / ( scrollDuration / 15 ),
		        cosParameter = scrollHeight / 2;
		var     scrollCount = 0,
		        scrollMargin,
		        scrollInterval = setInterval( function() {
		            if ( window.scrollY != 0 ) {
		                scrollCount = scrollCount + 1;  
		                scrollMargin = cosParameter - cosParameter * Math.cos( scrollCount * scrollStep );
		                window.scrollTo( 0, ( scrollHeight - scrollMargin ) );
		            } 
		            else clearInterval(scrollInterval); 
		        }, 15 );
		}
		</script>
		<!-- TOPO - FIM -->
	
	</div>
	<?php include "rodape.php"; ?>
</html>
</body>