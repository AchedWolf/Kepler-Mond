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
		
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ ?>
			<a href="adm-config.php" title="Voltar ao Menu"><div id="icon-img" style="background-image: url('imagens/voltar.png');height:30px;margin-right:7px;float:left;margin-top:20px;"></div></a>
			<h2>Área do Administrador</h2><hr class="est1">
			
			<h4 style="height:25px;"><b>Configurações do Site > Páginas</b></h4>
			
			<!-- INICIO - SOBRE POPUP -->
			<a href="#sobre" data-toggle="modal">Sobre</a>
			<!-- Modal -->
			<div class="modal fade" id="sobre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body" style="color:black;">
							<h3 style="margin-top:-3px;">Página "Sobre"</h3><hr class="est1">
							
							<?php							
							$consulta_sobre = $db->prepare('SELECT * FROM paginas');
							$consulta_sobre->execute();
							
							$num_linhas_sobre = $consulta_sobre->rowCount();
							
							if($num_linhas_sobre < 1)
							{ ?>
								Algo deu errado.
							<?php }
							else
							{
								$linha_sobre = $consulta_sobre->fetch(PDO::FETCH_ASSOC);
							?>
							
							<h4 style="margin-top:15px;"><b>Privacidade</b></h4>
							<!-- Deixar a página de Streaming visível para todos os usuários. -->
							<?php if($linha_sobre['sobre']=='s'){ ?>
							<div style="background-color:black;color:white;padding:7px;width:300px;border-radius:8px;margin-bottom:5px;">
								A página se encontra privada para usuários comuns.
							</div>
							<form action="adm-priv.php" method="post">
								<input type="hidden" name="acao" value="sobre_pub">
								<input type="submit" value="Tornar Pública"><br>
							</form>
							<?php } ?>
							
							<!-- Deixar a página de Streaming visível somente para os admins. -->
							<?php if($linha_sobre['sobre']=='n'){ ?>
							<form action="adm-priv.php" method="post">
								<input type="hidden" name="acao" value="sobre_priv">
								<input type="submit" value="Tornar Privada"><br>
							</form>
							<?php }
							} ?>
							<br>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
							<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Salvar">
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- FIM - SOBRE POPUP --><br>
			
			<!-- INICIO - VÍDEOS POPUP -->
			<a href="#videos" data-toggle="modal">Vídeos</a>
			<!-- Modal -->
			<div class="modal fade" id="videos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body" style="color:black;">
							<h3 style="margin-top:-3px;">Página "Vídeos"</h3><hr class="est1">
							
							<?php							
							$consulta_videos = $db->prepare('SELECT * FROM paginas');
							$consulta_videos->execute();
							
							$num_linhas_videos = $consulta_videos->rowCount();
							
							if($num_linhas_videos < 1)
							{ ?>
								Algo deu errado.
							<?php }
							else
							{
								$linha_videos = $consulta_videos->fetch(PDO::FETCH_ASSOC);
							?>
							
							<h4 style="margin-top:15px;"><b>Privacidade</b></h4>
							<!-- Deixar a página de Streaming visível para todos os usuários. -->
							<?php if($linha_videos['videos']=='s'){ ?>
							<div style="background-color:black;color:white;padding:7px;width:300px;border-radius:8px;margin-bottom:5px;">
								A página se encontra privada para usuários comuns.
							</div>
							<form action="adm-priv.php" method="post">
								<input type="hidden" name="acao" value="videos_pub">
								<input type="submit" value="Tornar Pública"><br>
							</form>
							<?php } ?>
							
							<!-- Deixar a página de Streaming visível somente para os admins. -->
							<?php if($linha_videos['videos']=='n'){ ?>
							<form action="adm-priv.php" method="post">
								<input type="hidden" name="acao" value="videos_priv">
								<input type="submit" value="Tornar Privada"><br>
							</form>
							<?php }
							} ?>
							<br>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
							<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Salvar">
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- FIM - VÍDEOS POPUP --><br>
			
			<!-- INICIO - STREAM POPUP -->
			<a href="#stream" data-toggle="modal">Stream</a>
			<!-- Modal -->
			<div class="modal fade" id="stream" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body" style="color:black;">
							<h3 style="margin-top:-3px">Página "<i>Stream</i>"</h3><hr class="est1">
							
							<?php							
							$consulta_stream = $db->prepare('SELECT * FROM livestream');
							$consulta_stream->execute();
							
							$num_linhas_stream = $consulta_stream->rowCount();
							
							if($num_linhas_stream < 1)
							{ ?>
								Algo deu errado.
							<?php }
							else
							{
								$linha_stream = $consulta_stream->fetch(PDO::FETCH_ASSOC);
							?>
							
							<h4 style="margin-top:15px;"><b>Privacidade</b></h4>
							<!-- Deixar a página de Streaming visível para todos os usuários. -->
							<?php if($linha_stream['privado']=='s'){ ?>
							<div style="background-color:black;color:white;padding:7px;width:300px;border-radius:8px;margin-bottom:5px;">
								A página se encontra privada para usuários comuns.
							</div>
							<form action="adm-priv.php" method="post">
								<input type="hidden" name="acao" value="stream_pub">
								<input type="submit" value="Tornar Pública"><br>
							</form>
							<?php } ?>
							
							<!-- Deixar a página de Streaming visível somente para os admins. -->
							<?php if($linha_stream['privado']=='n'){ ?>
							<form action="adm-priv.php" method="post">
								<input type="hidden" name="acao" value="stream_priv">
								<input type="submit" value="Tornar Privada"><br>
							</form>
							<?php } ?>
							
							<script>
							function elink()
							{
								var linkcomp = "https://www.youtube-nocookie.com/embed/" + document.getElementById("stream_ytlink").value + "?rel=0&amp;showinfo=0";
								var linkwatch = "https://www.youtube.com/watch?v=" + document.getElementById("stream_ytlink").value;
								document.getElementById("linkyoutube1").value = linkwatch;
								document.getElementById("ytlink").src = linkcomp;
							}
							</script>
							
							<h4 style="margin-top:25px;"><b>Transmissão</b></h4>
							<!-- Alterar a URL da transmissão que será mostrada na página de Streaming. -->				
							<form action="adm-stream_enviar.php" method="post">
								<input type="hidden" name="acao" value="stream_url">
								
								<input type="text" name="stream_ytlink" id="stream_ytlink" value="<?php echo $linha_stream[stream_ytlink]; ?>" OnChange="elink()" required>
								<input type="hidden" id="linkyoutube1" name="linkyoutube1">
								
								<input type="submit" value="Atualizar URL"><br>
							</form>
							Preview:<br>
							<iframe width="300" height="168" src="https://www.youtube-nocookie.com/embed/<?php echo $linha_stream[stream_ytlink]; ?>?rel=0&amp;showinfo=0" id="ytlink" frameborder="0"></iframe>
							<br>
							<?php } ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
							<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Salvar">
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- FIM - STREAM POPUP --><br>
			
			<!-- INICIO - PERFIL POPUP -->
			<a href="#perfil" data-toggle="modal">Perfil</a>
			<!-- Modal -->
			<div class="modal fade" id="perfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body" style="color:black;">
							<h3 style="margin-top:-3px;">Página "Perfil"</h3><hr class="est1">
							
							<?php							
							$consulta_perfil = $db->prepare('SELECT * FROM paginas');
							$consulta_perfil->execute();
							
							$num_linhas_perfil = $consulta_perfil->rowCount();
							
							if($num_linhas_perfil < 1)
							{ ?>
								Algo deu errado.
							<?php }
							else
							{
								$linha_perfil = $consulta_perfil->fetch(PDO::FETCH_ASSOC);
							?>
							
							<h4 style="margin-top:15px;"><b>Privacidade</b></h4>
							<!-- Deixar a página de Streaming visível para todos os usuários. -->
							<?php if($linha_perfil['perfil']=='s'){ ?>
							<div style="background-color:black;color:white;padding:7px;width:300px;border-radius:8px;margin-bottom:5px;">
								A página se encontra privada para usuários comuns.
							</div>
							<form action="adm-priv.php" method="post">
								<input type="hidden" name="acao" value="perfil_pub">
								<input type="submit" value="Tornar Pública"><br>
							</form>
							<?php } ?>
							
							<!-- Deixar a página de Streaming visível somente para os admins. -->
							<?php if($linha_perfil['perfil']=='n'){ ?>
							<form action="adm-priv.php" method="post">
								<input type="hidden" name="acao" value="perfil_priv">
								<input type="submit" value="Tornar Privada"><br>
							</form>
							<?php }
							} ?>
							<br>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
							<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Salvar">
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- FIM - PERFIL POPUP --><br>
			
			<!-- INICIO - INSTITUIÇOES POPUP -->
			<a href="#instituicoes" data-toggle="modal">Instituições</a>
			<!-- Modal -->
			<div class="modal fade" id="instituicoes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body" style="color:black;">
							<h3 style="margin-top:-3px;">Página "Instituições"</h3><hr class="est1">
							
							<?php							
							$consulta_instituicoes = $db->prepare('SELECT * FROM paginas');
							$consulta_instituicoes->execute();
							
							$num_linhas_instituicoes = $consulta_instituicoes->rowCount();
							
							if($num_linhas_instituicoes < 1)
							{ ?>
								Algo deu errado.
							<?php }
							else
							{
								$linha_instituicoes = $consulta_instituicoes->fetch(PDO::FETCH_ASSOC);
							?>
							
							<h4 style="margin-top:15px;"><b>Privacidade</b></h4>
							<!-- Deixar a página de Streaming visível para todos os usuários. -->
							<?php if($linha_instituicoes['instituicoes']=='s'){ ?>
							<div style="background-color:black;color:white;padding:7px;width:300px;border-radius:8px;margin-bottom:5px;">
								A página se encontra privada para usuários comuns.
							</div>
							<form action="adm-priv.php" method="post">
								<input type="hidden" name="acao" value="instituicoes_pub">
								<input type="submit" value="Tornar Pública"><br>
							</form>
							<?php } ?>
							
							<!-- Deixar a página de Streaming visível somente para os admins. -->
							<?php if($linha_instituicoes['instituicoes']=='n'){ ?>
							<form action="adm-priv.php" method="post">
								<input type="hidden" name="acao" value="instituicoes_priv">
								<input type="submit" value="Tornar Privada"><br>
							</form>
							<?php }
							} ?>
							<br>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
							<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Salvar">
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- FIM - INSTITUIÇOES POPUP --><br>
			
			
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