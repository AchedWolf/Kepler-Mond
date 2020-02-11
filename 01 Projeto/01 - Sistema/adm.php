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
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ ?>
			<h2>Área do Administrador</h2>
			
			<hr class="est1">
			<h4><b>Geral</b></h4>
			
			<a href="adm-stats.php">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				<div id="icon-img" style="background-image: url('imagens/stats.png');height:30px;margin-right:7px;"></div>
				Estatísticas
				</div>
			</a>
			
			<a href="adm-config.php">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				<div id="icon-img" style="background-image: url('imagens/config-2.png');height:30px;margin-right:7px;"></div>
				Configurações do Site
				</div>
			</a>
			
			
			
			<br><br><hr class="est1">
			<h4><b>Gerenciar Contas</b></h4>
			
			
			<a href="adm-users.php">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				<div id="icon-img" style="background-image: url('imagens/users.png');height:30px;margin-right:7px;"></div>
				Usuários
				</div>
			</a>
			
			<a href="adm-users.php?tipo=1">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				<div id="icon-img" style="background-image: url('imagens/user-adm.png');height:30px;margin-right:7px;"></div>
				Administradores
				</div>
			</a>
			
			<a href="adm-instituicoes.php">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				<div id="icon-img" style="background-image: url('imagens/instituicao.png');height:35px;margin-right:7px;"></div>
				Instituições
				</div>
			</a>
			
			
			<br><br><hr class="est1">
			<h4><b>Ferramentas do Admin</b></h4>
			
			<a href="adm-anuncios.php">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:30px;">
				<div id="icon-img" style="background-image: url('imagens/megafone2.png');background-size:30px 30px;background-repeat: no-repeat;background-position: center;height:30px;margin-right:7px;"></div>
				Anúncios
				</div>
			</a>
			
			<a href="adm-denuncias.php">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:30px;">
				<div id="icon-img" style="background-image: url('imagens/denunciar.png');height:30px;margin-right:7px;"></div>
				Denúncias
				</div>
			</a>
			
			
			
			<br><br><hr class="est1">
			<h4><b>Vídeos</b></h4>
			
			<a href="adm-videos.php">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				<div id="icon-img" style="background-image: url('imagens/youtube_player.png');height:30px;margin-right:7px;"></div>
				Vídeos Salvos
				</div>
			</a>
			
			<a href="adm-stream.php">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				<div id="icon-img" style="background-image: url('imagens/camera.png');height:30px;margin-right:7px;"></div>
				Configurar Streaming
				</div>
			</a>
			
			
			
			<br><br><hr class="est1">
			<h4><b>Astros</b></h4>
			
			<a href="adm-astros.php?tipo=estrela">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				<div id="icon-img" style="background-image: url('imagens/favs.png');height:30px;margin-right:7px;"></div>
				Estrelas
				</div>
			</a>
			
			<a href="adm-astros.php?tipo=planeta">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				<div id="icon-img" style="background-image: url('imagens/planeta.png');height:30px;margin-right:7px;"></div>
				Planetas
				</div>
			</a>
			
			<a href="adm-astros.php?tipo=satelite">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				<div id="icon-img" style="background-image: url('imagens/lua.png');height:30px;margin-right:7px;"></div>
				Satélites
				</div>
			</a>
			<a href="adm-astros.php?tipo=cometa">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				<div id="icon-img" style="background-image: url('imagens/cometa.png');height:30px;margin-right:7px;"></div>
				Cometas
				</div>
			</a>
			<a href="adm-astros.php?tipo=asteroide">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				<div id="icon-img" style="background-image: url('imagens/asteroides.png');background-size:35px;height:30px;margin-right:7px;"></div>
				Asteróides
				</div>
			</a>
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