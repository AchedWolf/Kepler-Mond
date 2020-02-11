<?php
session_start(); 
include "conecta.php";

		$id_inst = $_GET['i'];
		
		$consulta_inst = $db->prepare('SELECT * FROM instituicao WHERE id_inst = ? AND excluido = \'n\'');
		$consulta_inst->bindParam(1,$id_inst, PDO::PARAM_STR);
		$consulta_inst->execute();
		
		$num_linhas_inst = $consulta_inst->rowCount();
		
		$linha_inst = $consulta_inst->fetch(PDO::FETCH_ASSOC);
?> <html>
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
	<title><?php if($num_linhas_inst < 1){ echo "Kepler"; } else{ echo "".$linha_inst['nome_inst']." - Kepler"; } ?></title>
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php"; ?>
	
		<?php
		
		if($num_linhas_inst < 1)
		{ 
			include "404.php";
		}
		else
		{
		?>
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
	
		<?php 
		//Verificar se o usuário logado faz parte da instituição.
		$consulta_relacao = $db->prepare('SELECT * FROM relacao WHERE id_inst = ? AND login = ?');
		$consulta_relacao->bindParam(1,$id_inst, PDO::PARAM_STR);
		$consulta_relacao->bindParam(2,$_SESSION['login'], PDO::PARAM_STR);
		$consulta_relacao->execute();
		$num_linhas_relacao = $consulta_relacao->rowCount();
		
		$linha_relacao = $consulta_relacao->fetch(PDO::FETCH_ASSOC);
		
		/////////////////////////////////////////////////////////////////////
		
		//Verificar se a página está privada.
		$consulta_priv = $db->prepare('SELECT * FROM paginas');
		$consulta_priv->execute();
		$num_linhas_priv = $consulta_priv->rowCount();
		
		if($num_linhas_priv < 1){ include "404.php"; }
		
		else{
			$linha_priv = $consulta_priv->fetch(PDO::FETCH_ASSOC);
			
			if($linha_priv['instituicao']=='s' && ($_SESSION['tipo']==0 || $_SESSION['tipo']==NULL)){ ?>
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
				if($linha_priv['instituicao']=='s' && $_SESSION['tipo']==1){ ?>
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
			
			<?php 
			if($_SESSION['logado'] == 1){
				?><!-- INICIO - DENUNCIAR POPUP -->
						<a href="#denunciar" data-toggle="modal" class="btn btn-primary btn3d" style="width:255px;margin-bottom:5px;color:white;">Denunciar</a>
						<!-- Modal -->
						<div class="modal fade" id="denunciar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body" style="color:black;">
										<form action="denuncia-enviar.php" method="post">
										<h3 style="margin-top:-3px;">Denunciar</h3>
										Você está denunciando a instituição <b><?php echo $linha_inst['nome_inst']; ?></b>.<br>
										Escolha abaixo o motivo da denúncia:<br><br>
										
											<input type="radio" name="motivo_den" id="assedio" value="assedio" style="width:20px;">
											<label for="assedio">Assédio</label><br>
											
											<input type="radio" name="motivo_den" id="perfil_ofensivo" value="perfil_ofensivo" style="width:20px;">
											<label for="perfil_ofensivo">Perfil ofensivo</label><br>
											
											<input type="radio" name="motivo_den" id="spam" value="spam" style="width:20px;">
											<label for="spam">Spam/Flood</label><br>
											
											<input type="radio" name="motivo_den" id="abuso_tele" value="abuso_tele" style="width:20px;">
											<label for="abuso_tele">Abuso do telescópio</label><br>
											
											<input type="radio" name="motivo_den" id="perfil_falso" value="perfil_falso" style="width:20px;">
											<label for="perfil_falso">Perfil falso</label><br><br>
											
											<input type="hidden" name="tipo_denunciado" id="tipo_denunciado" value="i">	
											<input type="hidden" name="id_denunciado" id="id_denunciado" value="<?php echo $linha_inst['id_inst']; ?>">
											<input type="hidden" name="nome_denunciado" id="nome_denunciado" value="<?php echo $linha_inst['nome_inst']." (ID: ".$linha_inst['id_inst'].")"; ?>">
										<textarea placeholder="Descrição da violação..." style="width:565px;height:150px;padding:7px;" name="descr_den"></textarea>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
										<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Enviar">
										</form>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
						<!-- FIM - DENUNCIAR POPUP --><?php
				
				if($num_linhas_relacao > 0||$_SESSION['tipo']==1){ //Se usuário fizer parte da instituição.
					?><!-- INICIO - CONVIDAR POPUP -->
						<a href="#convidar" data-toggle="modal" class="btn btn-primary btn3d" style="width:255px;margin-bottom:5px;color:white;">Convidar usuários</a>
						<!-- Modal -->
						<div class="modal fade" id="convidar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body" style="color:black;">
										<form action="inst-convidar.php" method="post">
										<h3 style="margin-top:-3px;">Convidar usuários</h3>
										Insira abaixo o nome do usuário que deseja convidar para <b><?php echo $linha_inst['nome_inst']; ?></b>:<br><br>
											
											<center><input type="text" placeholder="Nome de usuário" name="para_login"></center>
											<input type="hidden" value="<?php echo $linha_inst['id_inst']; ?>" name="id_inst">
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
										<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Convidar">
										</form>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
						<!-- FIM - CONVIDAR POPUP -->
				<?php }
				
				if($linha_relacao['tipo'] == 1){ //Se usuário for admin da instituição.
					?>
					<a href="inst_edit.php?i=<?php echo $id_inst; ?>" class="btn btn-primary btn3d" style="width:255px;margin-bottom:5px;color:white;">Editar Dados</a>
				<?php }
				
				if($linha_relacao['tipo'] == 1){ //Se usuário for admin da instituição.
					?>
					<a href="inst_cargos.php?i=<?php echo $id_inst; ?>" class="btn btn-primary btn3d" style="width:255px;margin-bottom:5px;color:white;">Gerenciar Cargos</a>
				<?php }
				
				if($_SESSION['tipo'] == 1 || $linha_relacao['tipo'] == 1){
				?>
					<a href="#excluir" data-toggle="modal" class="btn btn-primary btn3d" style="width:255px;margin-bottom:5px;color:white;">Excluir</a>
						<div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body" style="color:black;">
									<form action="adm_excluir_inst.php" method="post" >
										<input type="hidden" name="inst_excluir_aprovada" id="inst_excluir_aprovada" value="<?php echo $linha_inst['id_inst']; ?>">
										<input type="hidden" name="aprovada" id="aprovada" value="">
										<input type="hidden" name="index_instituicoes" id="index_instituicoes" value="">
										<h3 style="margin-top:-3px;">Excluir Instituição de Ensino</h3>
										
										Deseja excluir a Instituição de Ensino <b><?php echo $linha_inst['nome_inst']; ?></b>?
								</div>
								<div class="modal-footer">
											<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
											<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Confirmar">
									</form>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
			<!-- FIM - EXCLUIR SOLICITAÇÃO CADASTRO POPUP -->
				<?php
				}
			echo "<br><br>";
			} //FIM - Se estiver logado. ?>
			
			
			<div id="item-esquerda">
				<div id="ie-titulo">Também disponível em</div>
				<div id="ie-cont" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
				
					<div id="icon-img" style="background-image: url('imagens/email.png');margin-top:-5px;" title="E-Mail"></div><font style="word-wrap: break-word;"><?php echo $linha_inst['email_inst']; ?></font><br><br>
					
					<?php 
					if($linha_inst['link_inst']!=NULL){ ?>
					<a href="<?php echo $linha_inst['link_inst']; ?>"><div id="icon-img" style="background-image: url('imagens/link.png');margin-top:-7px;" title="Website"></div><?php echo $linha_inst['link_inst']; ?></a>
					<?php } ?>
				</div>
			</div>

			<?php			
			//Selecionar membros comuns.
			$consulta_membros  = $db->prepare("SELECT * FROM relacao,usuario WHERE relacao.id_inst = ? AND relacao.login = usuario.login AND relacao.tipo = 0;");
			$consulta_membros->bindParam(1,$linha_inst['id_inst'], PDO::PARAM_STR);
			$consulta_membros->execute();
			$num_linhas_membros = $consulta_membros->rowCount();
			
			//Selecionar membros administradores.
			$consulta_membros_adm  = $db->prepare("SELECT * FROM relacao,usuario WHERE relacao.id_inst = ? AND relacao.login = usuario.login AND relacao.tipo = 1;");
			$consulta_membros_adm->bindParam(1,$linha_inst['id_inst'], PDO::PARAM_STR);
			$consulta_membros_adm->execute();
			$num_linhas_membros_adm = $consulta_membros_adm->rowCount();
			
			//Selecionar membros moderadores.
			$consulta_membros_mod  = $db->prepare("SELECT * FROM relacao,usuario WHERE relacao.id_inst = ? AND relacao.login = usuario.login AND relacao.tipo = 2;");
			$consulta_membros_mod->bindParam(1,$linha_inst['id_inst'], PDO::PARAM_STR);
			$consulta_membros_mod->execute();
			$num_linhas_membros_mod = $consulta_membros_mod->rowCount();
			?>
			
		</div>
		<!--Menu da Esquerda - FIM -->
			
		<!--Menu do Centro - INICIO -->		
		<div id="cont-direita">
			
			<div style="border:1px solid #D8D8D8;border-radius:8px 8px 0px 0px;padding:10px;width:700px;max-width:700px;min-height:120px;background-color:white;float:left;">
				<img src="<?php echo $linha_inst['banner']; ?>" style="width:675px;height:200px;border:1px solid black;float:left;">
				<div style="background-image: url('<?php echo $linha_inst['avatar_inst']; ?>');background-size:130px;background-repeat: no-repeat;background-position: center;background-color:transparent;width:130px;height:130px;float:left;margin-right:15px;margin-top:-100px;margin-left:10px;border-radius:10px;"></div>
				
				<div id="usuario-pgperfil" style="float:left;width:515px;margin-top:6px;">
					<span style="font-size:20px;margin-top:10px;"><?php echo $linha_inst['nome_inst']; ?></font>
				</div><br><br>
			</div>
			
			<div style="border:1px solid #D8D8D8;padding:10px;padding-top:0px;width:700px;max-width:700px;min-height:40px;background-color:white;float:left;">
				<div class="col-md-4 user-pad text-center">
					<h3>MEMBROS</h3>
					<h4><?php echo ($num_linhas_membros+$num_linhas_membros_adm+$num_linhas_membros_mod); ?></h4>
				</div>
			</div>
			
			<div style="border:1px solid #D8D8D8;border-radius:0px 0px 8px 8px;padding:10px;width:700px;max-width:700px;min-height:150px;background-color:white;float:left;">				
				<div id="perfil-sobre" style="min-height:100px;width:680px;background-color:white;float:left;padding:10px;padding-top:0px;border:0px;margin-bottom:10px;overflow:hidden;">
					<h4><b>Sobre</b></h4>
					<?php echo $linha_inst['sobre_inst']; ?>
				</div><br><br>
				
				<!-- <img src="imagens/offline.png" height="16px" title="Status" style="margin-left:14px"> Offline<br> -->
				
				<br>				
				<?php if ($linha_inst['cidade_inst'] != NULL){ ?>
					<div id="icon-img" style="background-image: url('imagens/localizacao.png');margin-top:-5px;" title="Localização"></div>
					<?php echo $linha_inst['cidade_inst'];
					
					if($linha_inst['estado_inst'] != NULL){
						echo ", ".$linha_inst['estado_inst']."<br>";
					}
					if($linha_inst['endereco_inst'] != NULL && $linha_inst['bairro_inst'] != NULL){
						echo $linha_inst['endereco_inst'];
						echo ", ".$linha_inst['bairro_inst'];
					}
				} ?>
				
				<hr class="est1">
				<h4><b>Membros</b>
				<a href="inst_membros.php?i=<?php echo $linha_inst['id_inst']; ?>" style="float:right;font-size:14px">Ver Todos <?php echo "(".($num_linhas_membros+$num_linhas_membros_adm).")"; ?></a></h4>
					<?php
					if($num_linhas_membros > 0 || $num_linhas_membros_adm > 0 || $num_linhas_membros_mod > 0){
						if($num_linhas_membros_adm > 0){
							echo '<span style="font-size:13px;font-weight:bold;">Administradores</span><br>';
							echo '<div style="float:left;width:100%">';
							while($linha_membros_adm = $consulta_membros_adm->fetch(PDO::FETCH_OBJ)){ ?>
								<a href="perfil.php?userp=<?php echo $linha_membros_adm->login; ?>" style="margin-right:5px;margin-bottom:5px;text-decoration: none;">
									<div style="background-image: url('<?php echo $linha_membros_adm->avatar; ?>');background-size:50px;background-repeat: no-repeat;
									background-position:center;background-color:black;height:50px;width:50px;float:left;margin-right:5px;border:1px solid #bdbdbd;" 
									title="<?php echo $linha_membros_adm->login; ?>"></div>
								</a>
							<?php }
							echo '</div>';
						}
						
						if($num_linhas_membros_mod > 0){
							echo '<br><span style="font-size:13px;font-weight:bold;">Moderadores</span><br>';
							echo '<div style="float:left;width:100%">';
							while($linha_membros_mod = $consulta_membros_mod->fetch(PDO::FETCH_OBJ)){ ?>
								<a href="perfil.php?userp=<?php echo $linha_membros_mod->login; ?>" style="margin-right:5px;margin-bottom:5px;text-decoration: none;">
									<div style="background-image: url('<?php echo $linha_membros_mod->avatar; ?>');background-size:50px;background-repeat: no-repeat;
									background-position:center;background-color:black;height:50px;width:50px;float:left;margin-right:5px;border:1px solid #bdbdbd;" 
									title="<?php echo $linha_membros_mod->login; ?>"></div>
								</a>
							<?php }
							echo '</div>';
						}
						
						if($num_linhas_membros > 0){
							echo '<br><span style="font-size:13px;font-weight:bold;">Usuários<span><br>';
							echo '<div style="float:left;width:100%">';
							while($linha_membros = $consulta_membros->fetch(PDO::FETCH_OBJ)){ ?>
								<a href="perfil.php?userp=<?php echo $linha_membros->login; ?>" style="margin-right:5px;margin-bottom:5px;text-decoration: none;">
									<div style="background-image: url('<?php echo $linha_membros->avatar; ?>');background-size:50px;background-repeat: no-repeat;
									background-position:center;background-color:black;height:50px;width:50px;float:left;margin-right:5px;border:1px solid #bdbdbd;" 
									title="<?php echo $linha_membros->login; ?>"></div>
								</a>
							<?php }
							echo '</div>';
						}
					}
						
					else{
						echo "Esta instituição não possui membros. Talvez ela tenha sido abandonada. :(";
					} ?>
			</div>
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