<?php session_start(); ?> <html>
<head>
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
		
		<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ ?>
			<a href="adm.php" title="Voltar ao Menu"><div id="icon-img" style="background-image: url('imagens/voltar.png');height:30px;margin-right:7px;float:left;margin-top:20px;"></div></a>
			<h2>Área do Administrador</h2><hr class="est1">
			
			<h4 style="height:25px;"><b>Configurar Streaming</b></h4>
			
			<?php
			include "conecta.php";
			
			$consulta = $db->prepare('SELECT * FROM livestream');
			$consulta->execute();
			
			$num_linhas = $consulta->rowCount();
			
			if($num_linhas < 1)
			{ ?>
				Algo deu errado.
			<?php }
			else
			{
				$linha = $consulta->fetch(PDO::FETCH_ASSOC);
			?>
			
			<h4><b>Privacidade</b></h4>
			<!-- Deixar a página de Streaming visível para todos os usuários. -->
			<?php if($linha['privado']=='s'){ ?>
			<div style="background-color:black;color:white;padding:7px;width:300px;border-radius:8px;margin-bottom:5px;">
				A página se encontra privada para usuários comuns.
			</div>
			<form action="adm-stream_enviar.php" method="post">
				<input type="hidden" name="acao" value="stream_pub">
				<input type="submit" value="Tornar Pública"><br>
			</form>
			<?php } ?>
			
			<!-- Deixar a página de Streaming visível somente para os admins. -->
			<?php if($linha['privado']=='n'){ ?>
			<form action="adm-stream_enviar.php" method="post">
				<input type="hidden" name="acao" value="stream_priv">
				<input type="submit" value="Tornar Privada"><br>
			</form>
			<?php } ?>
			<br>
			
			<script>
			function elink()
			{
				var linkcomp = "https://www.youtube-nocookie.com/embed/" + document.getElementById("stream_ytlink").value + "?rel=0&amp;showinfo=0";
				var linkwatch = "https://www.youtube.com/watch?v=" + document.getElementById("stream_ytlink").value;
				document.getElementById("linkyoutube1").value = linkwatch;
				document.getElementById("ytlink").src = linkcomp;
			}
			</script>
			
			<h4><b>Transmissão</b></h4>
			<!-- Alterar a URL da transmissão que será mostrada na página de Streaming. -->				
			<form action="adm-stream_enviar.php" method="post">
				<input type="hidden" name="acao" value="stream_url">
				
				<input type="text" name="stream_ytlink" id="stream_ytlink" value="<?php echo $linha[stream_ytlink]; ?>" OnChange="elink()" required>
				<input type="hidden" id="linkyoutube1" name="linkyoutube1">
				
				<input type="submit" value="Atualizar URL"><br>
			</form>
			Preview:<br>
			<iframe width="300" height="168" src="https://www.youtube-nocookie.com/embed/<?php echo $linha[stream_ytlink]; ?>?rel=0&amp;showinfo=0" id="ytlink" frameborder="0"></iframe>
			
			<?php } ?>
			
		<?php }
		else{ ?><br><font style="color:red;font-weight:bold;">Você não possui permissão para visualizar esta página.</font><?php } ?>
		</div>
	
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