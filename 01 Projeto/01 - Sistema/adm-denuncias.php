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
	<?php 
	include "cabecalho.php";
	include "conecta.php";
	
	$consulta = $db->prepare('SELECT * FROM denuncias ORDER BY data_den DESC');
	$consulta->execute();
	
	$num_linhas = $consulta->rowCount();
	
	if($num_linhas < 1){ include "404.php"; }
	else
	{ ?>
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ ?>
			<a href="adm.php" title="Voltar ao Menu"><div id="icon-img" style="background-image: url('imagens/voltar.png');height:30px;margin-right:7px;float:left;margin-top:20px;"></div></a>
			<h2>Área do Administrador</h2><hr class="est1">
			
			<h4 style="height:25px;"><b>Denúncias</b></h4>
			
			<!-- TABELA - td = resultado; th = titulo -->
			<table style="border:1px solid;padding:5px;font-size:13px;width:960px;">
				<tr style="border:1px solid;padding:5px;background-color:#F2F2F2;">
					<th style="border:1px solid;padding:5px;">
						Denunciador
					</th>
					<th style="border:1px solid;padding:5px;">
						Denunciado
					</th>
					<th style="border:1px solid;padding:5px;">
						Motivo
					</th>
					<th style="border:1px solid;padding:5px;">
						Descrição
					</th>
					<th style="border:1px solid;padding:5px;">
						Data
					</th>
				</tr>
				<?php 
				while($linha = $consulta->fetch(PDO::FETCH_OBJ))
				{ ?>
					<tr style="border:1px solid;padding:5px;">
						<td style="border:1px solid;padding:5px;">
							<a href="perfil.php?userp=<?php echo $linha->login_den; ?>" target="_blank"><span style="color:#2E64FE;"><?php echo $linha->login_den; ?></span></a>
						</td>
						<td style="border:1px solid;padding:5px;">
							<a target="_blank" <?php if($linha->tipo_denunciado == 'u'){ ?>href="perfil.php?userp=<?php echo $linha->id_denunciado; ?>" <?php } else if($linha->tipo_denunciado == 'i'){ ?>href="instituicao.php?i=<?php echo $linha->id_denunciado; ?>" <?php } ?>><span style="color:#DF0101;font-weight:bold;"><?php if($linha->tipo_denunciado == 'i'){ echo "Instituição de ID: "; } echo $linha->id_denunciado; ?></span></a>
						</td>
						<td style="border:1px solid;padding:5px;width:120px;">
							<?php
							if($linha->motivo_den == "assedio"){ echo "Assédio"; }
							else if($linha->motivo_den == "perfil_ofensivo"){ echo "Perfil ofensivo"; }
							else if($linha->motivo_den == "spam"){ echo "Spam/Flood"; }
							else if($linha->motivo_den == "abuso_tele"){ echo "Abuso do telescópio."; }
							else if($linha->motivo_den == "perfil_falso"){ echo "Perfil falso."; }
							else if($linha->motivo_den == "outro"){ echo "Outro."; }
							?>
						</td>
						<td style="border:1px solid;padding:5px;">
							<?php if($linha->descr_den != NULL){ ?><span><?php echo ucfirst($linha->descr_den); ?></span> <?php } 
							else { echo "Nada Informado."; }?>
						</td>
						<td style="border:1px solid;padding:5px;">
							<?php echo $linha->data_den; ?>
						</td>
						<td style="border:0px solid;" width="40px">
							<!-- INICIO - APROVAR POPUP -->
							<a href="#aprovar<?php echo $linha->id_den; ?>" title="Aprovar" data-toggle="modal"><img src="imagens/sim.png"></a>
							<!-- Modal -->
							<div class="modal fade" id="aprovar<?php echo $linha->id_den; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-body" style="color:black;">
											<h3 style="margin-top:-3px;">Aprovar Denúncia</h3><hr class="est1">
											
											<div style="padding:10px;border:1px solid #dbdbdb;border-radius:7px;float:left;margin-bottom:10px;">
												<h4 style="margin-bottom:0px;margin-top:-2px;">Detalhes da denúncia:</h4><br>
												<div style="float:left;width:100%;background-color:white;border-color:0px;">
													<div style="background-color:white;width:100px;overflow:hidden;float:left;height:15px;">
													Denunciador:
													</div>
													<div style="background-color:white;width:150px;overflow:hidden;float:left;height:15px;">
													<?php echo $linha->login_den; ?>
													</div>
												</div>
												
												<div style="float:left;width:100%;background-color:white;border-color:0px;">
													<div style="background-color:white;width:100px;overflow:hidden;float:left;height:15px;">
													Denunciado:
													</div>
													<div style="background-color:white;width:150px;overflow:hidden;float:left;height:15px;">
													<?php echo $linha->id_denunciado; ?>
													</div>
												</div>
												
												<div style="float:left;width:100%;background-color:white;border-color:0px;">
													<div style="background-color:white;width:100px;overflow:hidden;float:left;height:15px;">
													Tipo:
													</div>
													<div style="background-color:white;width:150px;overflow:hidden;float:left;height:15px;">
													<?php if($linha->tipo_denunciado == 'u'){ echo "Usuário."; } else if($linha->tipo_denunciado == 'i'){ echo "Instituição."; } ?>
													</div>
												</div>
												
												<div style="float:left;width:100%;background-color:white;border-color:0px;">
													<div style="background-color:white;width:100px;overflow:hidden;float:left;height:15px;">
													Motivo:
													</div>
													<div style="background-color:white;width:150px;overflow:hidden;float:left;height:15px;">
													<?php
													if($linha->motivo_den == "assedio"){ echo "Assédio"; }
													else if($linha->motivo_den == "perfil_ofensivo"){ echo "Perfil ofensivo"; }
													else if($linha->motivo_den == "spam"){ echo "Spam/Flood"; }
													else if($linha->motivo_den == "abuso_tele"){ echo "Abuso do telescópio."; }
													else if($linha->motivo_den == "perfil_falso"){ echo "Perfil falso."; }
													else if($linha->motivo_den == "outro"){ echo "Outro."; }
													?>
													</div>
												</div>
												
												<div style="float:left;width:100%;background-color:white;border-color:0px;">
													<div style="background-color:white;width:100px;overflow:hidden;float:left;height:15px;">
													Descrição:
													</div>
													<div style="background-color:white;width:150px;overflow:hidden;float:left;height:15px;">
													<?php echo $linha->descr_den; ?>
													</div>
												</div>
												
												<div style="float:left;width:100%;background-color:white;border-color:0px;">
													<div style="background-color:white;width:100px;overflow:hidden;float:left;height:15px;">
													Data:
													</div>
													<div style="background-color:white;width:150px;overflow:hidden;float:left;height:15px;">
													<?php echo $linha->data_den; ?>
													</div>
												</div>
											</div>
											
											<?php if($linha->tipo_denunciado == 'i'){ echo "A instituição"; } else if($linha->tipo_denunciado == 'u'){ echo "O usuário"; } ?> de nome <?php echo $linha->id_denunciado; ?> receberá um banimento até:
											<br>
											
											<form action="adm-denuncias_aprov.php" method="post">
												<input type="hidden" name="id_denunciado" value="<?php echo $linha->id_denunciado; ?>">
												<input type="hidden" name="login_den" value="<?php echo $linha->login_den; ?>">
												<input type="hidden" name="tipo_denunciado" value="<?php echo $linha->tipo_denunciado; ?>">
												<input type="datetime-local" name="tempo_ban" style="padding:5px;margin-top:3px;" min="<?php echo date("Y-m-d")."T".date("h:i"); ?>" required><br>
											
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
											<input type="submit" class="btn btn-default pull-right" style="width:100px;" value="Aprovar">
											</form>
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
							<!-- FIM - APROVAR POPUP -->
						</td>
						<td style="border:0px solid;" width="40px">
							<a href="adm-denuncias_exc.php?id_den=<?php echo $linha->id_den; ?>" title="Excluir"><img src="imagens/nao.png"></a>
						</td>
					</tr>
				<?php 
				} ?>
			</table>			
		<?php } 
		else{ ?><br><font style="color:red;font-weight:bold;">Você não possui permissão para visualizar esta página.</font><?php } ?>
		
		</div>
	<?php } ?>
	
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