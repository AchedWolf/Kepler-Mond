<?php session_start();
	
	include "conecta.php";
	$user = $_GET['userp'];
	$userpdo=strtolower($user);
	
	$consulta_usuario = $db->prepare('SELECT * FROM usuario WHERE login = ? AND excluido = \'n\'');
	$consulta_usuario->bindParam(1,$userpdo, PDO::PARAM_STR);
	$consulta_usuario->execute();
	
	$num_linhas_usuario = $consulta_usuario->rowCount();
	
	$linha_usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);
?>
<html>
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
	<title><?php if($num_linhas_usuario < 1){ echo "Kepler"; } else{ echo "Perfil de ".$linha_usuario['login']." - Kepler"; } ?></title>
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php"; ?>
	
		<?php		
		if($num_linhas_usuario < 1)
		{ ?>
			<?php include "404.php"; ?>
		<?php }
		else
		{ 
		
		include "conecta.php";
		
		$consulta_priv = $db->prepare('SELECT * FROM paginas');
		$consulta_priv->execute();
		
		$num_linhas_priv = $consulta_priv->rowCount();
		
		if($num_linhas_priv < 1)
		{ 
			include "404.php";
		}
		
		else{
			$linha_priv = $consulta_priv->fetch(PDO::FETCH_ASSOC);
			
			?>
			<!--Menu da Esquerda - INICIO -->
			<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
			<?php
			
			if($linha_priv['perfil']=='s' && ($_SESSION['tipo']==0 || $_SESSION['tipo']==NULL)){ ?>
				<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
					<h2>
						<i>Ops!</i>
					</h2>
					<hr class="est1">
					<div style="background-color:black;color:white;padding:10px;width:950px;border-radius:8px;">Está página foi configurada como privada por um administrador, talvez ela esteja em manutenção no momento. Tente novamente mais tarde, pode ser que ela já esteja disponível.</div>
					
					<br>
					<center><img src="imagens/manutencao.jpg" height="300px"></center>
				</div>
			<?php 
			}
			
			else{
				if($linha_priv['perfil']=='s' && $_SESSION['tipo']==1){ ?>
					<div style="background-color:black;color:white;padding:10px;width:950px;border-radius:8px;">
					Está página se encontra privada para usuários comuns.
					</div><br>
				<?php } ?>
		
		<div id="cont-esquerda" style="margin-left:0px;">
		
			<!--<div id="item-esquerda">
				<div id="ie-titulo">Título</div>
				<div id="ie-cont">
				Coloque o conteúdo do item aqui.
				</div>
			</div>-->
			

			<div style="background-image: url('<?php echo $linha_usuario['avatar']; ?>');background-size:175px;background-repeat: no-repeat;background-position: center;background-color:black;width:175px;height:175px;border: 1px solid #bdbdbd; float:left;margin-right:15px;margin-left:45px;margin-bottom:10px;"></div>
			
			<?php 
			if($_SESSION['logado'] == 1){
				if($_SESSION['login'] == strtolower($user)){
					?><form action="perfil-edit.php"><input type="submit" class="btn btn-primary btn3d" style="width:255px;margin-bottom:5px;" value="Editar Dados"></form>
				<?php } ?>
				
						<!-- INICIO - DENUNCIAR POPUP -->
						<a href="<?php if($_SESSION['login'] != strtolower($user)) { echo "#denunciar"; } ?>" data-toggle="modal" class="btn btn-primary btn3d" style="width:255px;margin-bottom:5px;color:white;<?php if($_SESSION['login'] == strtolower($user)) { echo "cursor: default;opacity:0.5;color:#E4E4E4;pointer-events: none;"; } ?>">Denunciar</a>
						<?php if($_SESSION['login'] != strtolower($user)) { ?>
						<!-- Modal -->
						<div class="modal fade" id="denunciar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body" style="color:black;">
										<form action="denuncia-enviar.php" method="post">
										<h3 style="margin-top:-3px;">Denunciar</h3>
										Você está denunciando o usuário de nome <?php echo $linha_usuario['nome']." ".$linha_usuario['sobrenome']." (".$linha_usuario['login'].")"; ?>.<br>
										Escolha abaixo o motivo da denúncia:<br><br>
											
											<input type="hidden" name="id_denunciado" value="<?php echo $linha_usuario['login']; ?>">
											<input type="hidden" name="tipo_denunciado" value="u">
										
											<input type="radio" name="motivo_den" id="assedio" value="assedio" style="width:20px;">
											<label for="assedio">Assédio</label><br>
											
											<input type="radio" name="motivo_den" id="perfil_ofensivo" value="perfil_ofensivo" style="width:20px;">
											<label for="perfil_ofensivo">Perfil ofensivo</label><br>
											
											<input type="radio" name="motivo_den" id="spam" value="spam" style="width:20px;">
											<label for="spam">Spam/Flood</label><br>
											
											<input type="radio" name="motivo_den" id="abuso_tele" value="abuso_tele" style="width:20px;">
											<label for="abuso_tele">Abuso do telescópio</label><br>
											
											<input type="radio" name="motivo_den" id="outro" value="outro" style="width:20px;">
											<label for="outro">Outro</label><br><br>
											
										<textarea placeholder="Descrição da violação..." name="descr_den" style="width:565px;height:150px;padding:7px;"></textarea>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
										<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Enviar">
										</form>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
						<?php } ?>
						<!-- FIM - DENUNCIAR POPUP -->
					<?php
			}?>
			
			<div id="item-esquerda" style="margin-top:10px;">
				<div id="ie-titulo">Também disponível em</div>
				<div id="ie-cont" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
					
					<div id="icon-img" style="background-image: url('imagens/email.png');margin-top:-5px;" title="E-Mail"></div><font title="<?php echo $linha_usuario['email']; ?>"><?php echo $linha_usuario['email']; ?></font><br><br>
					
					<!--
					<a href="http://facebook.com"><div id="icon-img" style="background-image: url('imagens/facebook.png');margin-top:-5px;" title="Facebook"></div> Facebook</a><br><br>
					<a href="http://twitter.com"><div id="icon-img" style="background-image: url('imagens/twitter.png');margin-top:-5px;" title="Twitter"></div> Twitter</a><br><br>
					<a href="http://youtube.com"><div id="icon-img" style="background-image: url('imagens/youtube.png');margin-top:-5px;" title="YouTube"></div> YouTube</a>
					-->
					<?php 
					if($linha_usuario['link_user']!=NULL){ ?>
					<a href="<?php echo $linha_usuario['link_user']; ?>"><div id="icon-img" style="background-image: url('imagens/link.png');margin-top:-7px;" title="Website"></div><font id="font_link" title="<?php echo $linha_usuario['link_user']; ?>"><?php echo $linha_usuario['link_user']; ?></font></a>
					<?php } ?>
				</div>
			</div>

			<?php
			$user = $_GET['userp'];
			$userpdo=strtolower($user);
			
			$consulta_inst  = $db->prepare("SELECT * FROM relacao,instituicao WHERE relacao.login = ? AND relacao.id_inst = instituicao.id_inst AND instituicao.excluido = 'n';");
			$consulta_inst->bindParam(1,$userpdo, PDO::PARAM_STR);
			$consulta_inst->execute();
			
			$num_linhas_inst = $consulta_inst->rowCount();
			?>
			
			<div id="item-esquerda">
				<div id="ie-titulo" style=""><a href="instituicoes.php?userp=<?php echo $linha_usuario['login']; ?>">Instituições <?php echo "(".$num_linhas_inst.")"; ?></a></div>
				<div id="ie-cont" style="padding:10px;padding-left:15px;">
					<?php
					if($num_linhas_inst > 0){
						while($linha_inst = $consulta_inst->fetch(PDO::FETCH_OBJ)){ ?>
							<a href="instituicao.php?i=<?php echo $linha_inst->id_inst; ?>" title="<?php echo $linha_inst->nome_inst; ?>" style="text-decoration: none;">
								<img style="background-image: url('<?php echo $linha_inst->avatar_inst; ?>');background-size:50px;background-repeat: no-repeat;
								background-position:center;background-color:transparent;margin-bottom:10px;margin-right:5px;" 
								height="50px" width="50px">
							</a>
							<?php
						}
					}
						
					else{
						echo "Este usuário não faz parte de nenhuma instituição.";
					} ?>
				</div>
			</div>
			
		</div>
		<!--Menu da Esquerda - FIM -->
			
		<!--Menu do Centro - INICIO -->		
		<div id="cont-direita" style="border: 1px solid #D8D8D8;border-radius: 8px;;border-radius:8px;padding:10px;">
		
				<div id="usuario-pgperfil" style="float:left;font-size:20px;margin-top:5px;">
					<?php echo $linha_usuario['nome']." ".$linha_usuario['sobrenome']; ?>
					<?php if ($linha_usuario['tipo'] == 5){ ?><font style="border-radius:3px;color:white;background-color:#11aa2a;padding:3px;font-size:13px;font-weight:bold;cursor:pointer" title="Moderador do Banco">Moderador do Banco</font><?php } ?>
					<?php if ($linha_usuario['tipo'] == 4){ ?><font style="border-radius:3px;color:white;background-color:#f2b50e;padding:3px;font-size:13px;font-weight:bold;cursor:pointer" title="Moderador de Instituições">Moderador de Instituições</font><?php } ?>
					<?php if ($linha_usuario['tipo'] == 3){ ?><font style="border-radius:3px;color:white;background-color:#9023c6;padding:3px;font-size:13px;font-weight:bold;cursor:pointer" title="Moderador da Streaming">Moderador da Streaming</font><?php } ?>
					<?php if ($linha_usuario['tipo'] == 2){ ?><font style="border-radius:3px;color:white;background-color:black;padding:3px;font-size:13px;font-weight:bold;cursor:pointer" title="Programador">Programador</font><?php } ?>
					<?php if ($linha_usuario['tipo'] == 1){ ?><font style="border-radius:3px;color:white;background-color:#e80202;padding:3px;font-size:13px;font-weight:bold;cursor:pointer" title="Administrador">Administrador</font><?php } ?>
				</div><br><font style="float:left;margin-top:12px;">@<?php echo $linha_usuario['login']; ?></font><br><br>
				
				<?php 
				if($linha_usuario['num_agend']!=1){ ?>
					<b><?php echo $linha_usuario['num_agend']; ?></b> agendamentos realizados.
					<?php 
				}
				else{
					?><b><?php echo $linha_usuario['num_agend']; ?></b> agendamentos realizados.<?php
				}?>
				<br>
				
				<div id="perfil-sobre" style="min-height:100px;width:680px;background-color:white;float:left;padding:10px;border:0px;margin-bottom:10px;overflow:hidden;">
					<h4><b>Sobre</b></h4>
					<?php echo $linha_usuario['sobre']; ?>
				</div><br><br>
				
				<!-- <img src="imagens/offline.png" height="16px" title="Status" style="margin-left:14px"> Offline<br> -->
				
				<br>
				<?php if ($linha_usuario['data_nasc'] != NULL){ ?>
				<div id="icon-img" style="background-image: url('imagens/aniversario.png');margin-top:-5px;" title="Aniversário">
				</div> <?php echo $linha_usuario['data_nasc']; ?><br><br>
				<?php } ?>
				
				<?php if ($linha_usuario['cidade'] != NULL){ ?>
					<div id="icon-img" style="background-image: url('imagens/localizacao.png');margin-top:-5px;" title="Localização"></div>
					<?php echo $linha_usuario['cidade'];
					
					if($linha_usuario['estado'] != NULL){
						echo ", ".$linha_usuario['estado'];
					}?>
					
					<br><?php
				} ?>
		</div><?php } //fim do ELSE ?>
		<!--Menu do Centro - FIM -->
		<?php }
		} ?>
	
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