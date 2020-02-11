<?php
session_start(); 
include "conecta.php";
		$id_inst = $_GET['i'];
		
		$consulta_inst = $db->prepare('SELECT * FROM instituicao WHERE id_inst = ?');
		$consulta_inst->bindParam(1,$id_inst, PDO::PARAM_INT);
		$consulta_inst->execute();
		$num_linhas_inst = $consulta_inst->rowCount();
		$linha_inst = $consulta_inst->fetch(PDO::FETCH_ASSOC);
		
		$consulta_relacao = $db->prepare('SELECT * FROM relacao WHERE id_inst = ? AND tipo = 1');
		$consulta_relacao->bindParam(1,$id_inst, PDO::PARAM_INT);
		$consulta_relacao->execute();
		$num_linhas_relacao = $consulta_relacao->rowCount();
		$linha_relacao = $consulta_relacao->fetch(PDO::FETCH_ASSOC);
		$login=$linha_relacao['login'];
	
		$consulta_usuario=$db->prepare('SELECT * FROM usuario WHERE login = ?');
		$consulta_usuario->bindParam(1,$login,PDO::PARAM_STR);
		$consulta_usuario->execute();
		
		$num_linhas_usuario = $consulta_usuario->rowCount();
		if($num_linhas_usuario>0)
		{
			$linha_usuario = $consulta_usuario->fetch(PDO::FETCH_ASSOC);
		}			
		
?> <html>
<head>
	<link href="css/estilo23.css" rel="stylesheet" type="text/css">
	<link href="estilo23.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>
		<?php 
			echo "Visualizar Dados da Instituição ".$linha_inst['nome_inst']." - Kepler";
		?>
	</title>	
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php";
	
	if($num_linhas_inst < 1)
		{ ?>
			<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;"><div id="cont-centro" style="margin-left:0px">
			Esta instituição não existe. :(
			</div>
		<?php }
		else if($_SESSION['logado']!=1&&$_SESSION['tipo'] != 1){ ?><div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;"><div id="cont-centro" style="margin-left:0px;padding-top:23px;"><font style="color:red;font-weight:bold;">Você não possui permissão para visualizar esta página.</font></div><?php }
		else if($linha_inst['excluido']=='n'){
		?>
			<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;"><div id="cont-centro" style="margin-left:0px">Não é possível visualizar os dados dessa Instituição de Ensino.</div>
		<?php 
		}
		else{
		?>
		

		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
	<div id="cont-centro" style="padding-top:3px;margin-left:0px;width:890px">
	
		<?php 
			if($linha_inst['excluido']=='a')
			{
		?>
		<h2>Dados da Instituição Aguardando Aprovação</h2>
		
		<?php 
			}
			if($linha_inst['excluido']=='s'||$linha_inst['excluido']=='e')
			{
		?>
			<h2>Dados da Instituição</h2>
		<?php 
			}
		?>
		<div id="cad-ambos" style="background-color:transparent;min-width:800px;max-width:960px;width:800px;float:left;margin-bottom:10px;margin-top:10px;">
		
			
			<div style="background-color:transparent;float:right;border:1px solid #D8D8D8;border-radius:2px;padding:10px;width:280px;margin-top:40px">
				
					<div id="cad-avatarbox"><div id="avatar_inst" name="avatar_inst" style="background-image: url('<?php echo $linha_inst['avatar_inst']; ?>');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;"></div></div>
					Avatar<br>
					
			</div>
		
			<script type="text/javascript">
				var id_inst=0;
				function confirmacao(id_inst)
				{
					var nome_inst=document.getElementById('nome_inst_'+id_inst).value;
					document.getElementById('inst_aprovar').value=id_inst;
					document.getElementById('aprovar_nome_instituicao').innerHTML="Deseja aprovar a solicitação de cadastro da Instituição de Ensino  <b>"+nome_inst+"</b>?";
				}
				
				function reativar_inst(id_inst)
				{
					var nome_inst=document.getElementById('nome_inst_'+id_inst).value;
					document.getElementById('inst_ativar').value=id_inst;
					document.getElementById('ativar_nome_instituicao').innerHTML="Deseja reativar a Instituição de Ensino  <b>"+nome_inst+"</b>?";
				}
				
				function exclusao(id_inst)
				{
					var nome_inst=document.getElementById('nome_inst_'+id_inst).value;
					document.getElementById('inst_excluir').value=id_inst;
					document.getElementById('excluir_nome_instituicao').innerHTML="Deseja excluir a solicitação de cadastro da Instituição de Ensino  <b>"+nome_inst+"</b>?";
				}
			</script>
			
			<style>
				#nome_campo
				{
					background-color:transparent;
					width:100px;
					float:left;
				}
				
				#nome_campo_solicitante
				{
					background-color:transparent;
					width:130px;
					float:left;
				}
				
				#conteudo_campo
				{
					float:left;
					background-color:transparent;
					width:370px;
				}
				
				#conteudo_campo_solicitante
				{
					float:left;
					background-color:transparent;
					width:340px;
				}
			</style>
			
			<!-- Mensagens de Confirmação -->
			
			<div class="modal fade" id="excluir_solicitacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body" style="color:black;">
										<form action="adm_excluir_inst.php" method="post" >
											<input type="hidden" name="inst_excluir" id="inst_excluir" value="<?php echo $id_inst; ?>">
											<h3 style="margin-top:-3px;">Excluir Solicitação de Cadastro</h3>
											
											Deseja excluir a solicitação de cadastro da Instituição de Ensino <b><?php echo $linha_inst['nome_inst']; ?></b>?
											<br><br>
											
											Motivo:
											<br><br>
											<div id="motivo_campo">
												<textarea name="motivo" style="width:80%;height:100px" required ></textarea>
											</div>
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
					
			
			<div class="modal fade" id="confirmar_solicitacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body" style="color:black;">
										<form action="adm_aprovar_inst.php" method="post" >
											<input type="hidden" name="inst_aprovar" id="inst_aprovar" value="<?php echo $linha_inst['id_inst']; ?>">
											<h3 style="margin-top:-3px;">Aprovar Solicitação de Cadastro</h3>
											
											Deseja aprovar a solicitação de cadastro da Instituição de Ensino <b><?php echo $linha_inst['nome_inst']; ?></b>?
									</div>
									<div class="modal-footer">
												<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
												<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Confirmar">
										</form>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					<!-- FIM - APROVAR SOLICITAÇÃO CADASTRO POPUP -->
		
						<div class="modal fade" id="ativar_instituicao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body" style="color:black;">
										<form action="adm_aprovar_inst.php" method="post" >
											<input type="hidden" name="inst_ativar" id="inst_ativar" value="<?php echo $id_inst; ?>">
											<input type="hidden" name="ativar" id="ativar" value="">
											<h3 style="margin-top:-3px;">Aprovar Solicitação de Cadastro</h3>
											
											Deseja reativar a Instituição de Ensino <b><?php echo $linha_inst['nome_inst']; ?></b>?
									</div>
									<div class="modal-footer">
												<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
												<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Confirmar">
										</form>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
		<!-- FIM - APROVAR SOLICITAÇÃO CADASTRO POPUP -->				
			
			<!-- Fim das Mensagens de Confirmação-->
			
			<h4><b>Instituição de Ensino</b></h4>
			<div style="background-color:transparent;width:500px;float:left;border:1px solid #D8D8D8;border-radius:2px;padding:10px;">
				
				<div id="cad-linha">
					<div id="nome_campo">Nome:</div>
					<div id="conteudo_campo" ><?php echo $linha_inst['nome_inst']; ?></div><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="nome_campo">Endereço:</div>
					<div id="conteudo_campo"><?php echo $linha_inst['endereco_inst']; ?></div><br>
				</div>
				<div id="cad-linha">
					<div id="nome_campo">Bairro:</div>
					<div id="conteudo_campo"><?php echo $linha_inst['bairro_inst']; ?></div>
					<hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="nome_campo">Cidade:</div>
					<div id="conteudo_campo"><?php echo $linha_inst['cidade_inst']; ?></div><br>
				</div>
				<div id="cad-linha">
					<div id="nome_campo">Estado:</div>
					<div id="conteudo_campo" >
						
							<?php 
								switch($linha_inst['estado_inst'])
								{
									case "AC": echo "Acre";
											   break;	
									
									case "AL": echo "Alagoas";
											   break;	
											
									case "AM": echo "Amazonas";
											   break;	
									
									case "AP": echo "Amapá";
											   break;

									case "BA": echo "Bahia";
											   break;

									case "CE":echo "Ceará";
											  break;
											  
									case "DF": echo "Distrito Federal";
												break;
												
									case "ES": echo "Espírito Santo";
												break;
									
									case "GO": echo "Goiás";
												break;
												
									case "MA": echo "Maranhão";
												break;
												
									case "MG": echo "Minas Gerais";
												break;
									
									case "MS": echo "Mato Grosso do Sul";
												break;
									
									case "MT": echo "Mato Grosso";
												break;

									case "PA": echo "Pará";
												break;
										
									case "PB": echo "Paraíba";
												break;
									
									case "PE": echo "Pernambuco";
												break;
									
									case "PI": echo "Piauí";
												break;

									case "PR": echo "Paraná";
												break;
												
									case "RJ": echo "Rio de Janeiro";
												break;
												
									case "RN": echo "Rio Grande do Norte";
												break;
												
									case "RO": echo "Rondônia";
												break;
												
									case "RR": echo "Roraima";
												break;
												
									case "RS": echo "Rio Grande do Sul";
												break;
												
									case "SC": echo "Santa Catarina";
												break;
												
									case "SE": echo "Sergipe";
												break;
												
									case "SP": echo "São Paulo";
												break;
												
									case "TO": echo "Tocantins";
												break;
									
									default: echo "Não Informado";
											
								}
							?>
						
						
					</div><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="nome_campo">Telefone:</div>
					<div id="conteudo_campo"><?php echo $linha_inst['telefone_inst']; ?></div>
					<hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="nome_campo">E-Mail:
					</div>
					<div id="conteudo_campo">
						<?php echo $linha_inst['email_inst']; ?>
					</div>					
					<hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="nome_campo">Sobre:</div>
					<div id="conteudo_campo">
						<?php echo $linha_inst['sobre_inst']; ?>
					</div><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
				</div>
				<div id="cad-linha">
					<div id="nome_campo">Website:</div>
					<div id="conteudo_campo">
					
						<?php if($linha_inst['link_inst']==NULL){?>
							Não Informado
						<?php } else{?>
						<a href="<?php echo $linha_inst['link_inst']; ?>" target="_BLANK"><?php echo $linha_inst['link_inst']; ?></a>
						<?php }?>
						
					</div>
				</div>
			</div>
		</div>
		<?php if($num_linhas_usuario>0){?>
		<form style="display:inline;">
			<input type="hidden" name="id_inst" value="<?php echo $linha_inst['id_inst']; ?>">
					<input type="hidden" id="nome_inst" name="nome_inst" value="<?php echo $linha_inst['nome_inst']; ?>">
					<input type="hidden" id="avatar_inst_txt" name="avatar_inst_txt" value="<?php echo $linha_inst['avatar_inst']; ?>">
					<input type="hidden" id="img_modo" name="img_modo" value="<?php echo $linha_inst['avatar_inst']; ?>">
			
		</form>
		
			<div id="cad-ambos" style="background-color:transparent;min-width:800px;max-width:960px;width:800px;float:left;margin-bottom:10px;margin-top:10px;">
			
				<div style="background-color:transparent;width:450px;float:right;border:1px solid #D8D8D8;border-radius:2px;padding:10px;width:280px;margin-top:40px">
					<div id="cad-avatarbox"><div id="avatar_inst" name="avatar_inst" style="background-image: url('<?php echo $linha_usuario['avatar']; ?>');background-size:148px;background-repeat: no-repeat;background-position: center;background-color:black;width:148px;height:148px;border: 1px solid #bdbdbd; float:left;"></div></div>
					Avatar<br>
					
				</div>
				
				<h4><b>Solicitante</b></h4>
				<div style="background-color:transparent;width:500px;float:left;border:1px solid #D8D8D8;border-radius:2px;padding:10px;">
					<div id="cad-linha">
						<div id="nome_campo_solicitante">Nome:</div>
						<div id="conteudo_campo_solicitante" ><?php echo $linha_usuario['nome']; ?></div><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
					</div>
					<div id="cad-linha">
						<div id="nome_campo_solicitante">CPF:</div>
						<div id="conteudo_campo_solicitante">
							<?php 
								if($linha_usuario['cpf']!=null&&$linha_usuario['cpf']!="")
									echo $linha_usuario['cpf']; 
								else
									echo "Não Informado";
							?>
						</div><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
					</div>
					<div id="cad-linha">
						<div id="nome_campo_solicitante">Nível Acadêmico:</div>
						<div id="conteudo_campo_solicitante">
							<?php 
								switch($linha_usuario['nvl_acad'])
								{
										case "fund_incomp": echo "Ensino fundamental incompleto";
															break;
											
										case "fund_comp": echo "Ensino fundamental completo";
															break;
															
										case "medio_incomp": echo "Ensino médio incompleto"; 
															break;
															
										case "medio_comp": echo "Ensino médio completo";
															break;
										
										case "sup_incomp": echo "Ensino superior incompleto";
															break;
															
										case "sup_comp": echo "Ensino superior completo";
														break;
										
										case "pos_comp": echo "Pós graduação completa";
														break;
										
										default: echo "Não Informado";
								}
							?>					
							
					
						</div>
						<hr class="est1" style="margin-top:25px;margin-bottom:8px;">
					</div>
					<div id="cad-linha">
						<div id="nome_campo_solicitante">Cidade:</div>
						<div id="conteudo_campo_solicitante">
							<?php 
								if($linha_usuario['cidade']!=null&&$linha_usuario['cidade']!="")
									echo $linha_usuario['cidade']; 
								else
									echo "Não Informado";
							?>
						</div><br>
					</div>
					<div id="cad-linha">
						<div id="nome_campo_solicitante">Estado:</div>
						<div id="conteudo_campo_solicitante" >
							<?php 
								switch($linha_usuario['estado'])
								{
									case "AC": echo "Acre";
											   break;	
									
									case "AL": echo "Alagoas";
											   break;	
											
									case "AM": echo "Amazonas";
											   break;	
									
									case "AP": echo "Amapá";
											   break;

									case "BA": echo "Bahia";
											   break;

									case "CE":echo "Ceará";
											  break;
											  
									case "DF": echo "Distrito Federal";
												break;
												
									case "ES": echo "Espírito Santo";
												break;
									
									case "GO": echo "Goiás";
												break;
												
									case "MA": echo "Maranhão";
												break;
												
									case "MG": echo "Minas Gerais";
												break;
									
									case "MS": echo "Mato Grosso do Sul";
												break;
									
									case "MT": echo "Mato Grosso";
												break;

									case "PA": echo "Pará";
												break;
										
									case "PB": echo "Paraíba";
												break;
									
									case "PE": echo "Pernambuco";
												break;
									
									case "PI": echo "Piauí";
												break;

									case "PR": echo "Paraná";
												break;
												
									case "RJ": echo "Rio de Janeiro";
												break;
												
									case "RN": echo "Rio Grande do Norte";
												break;
												
									case "RO": echo "Rondônia";
												break;
												
									case "RR": echo "Roraima";
												break;
												
									case "RS": echo "Rio Grande do Sul";
												break;
												
									case "SC": echo "Santa Catarina";
												break;
												
									case "SE": echo "Sergipe";
												break;
												
									case "SP": echo "São Paulo";
												break;
												
									case "TO": echo "Tocantins";
												break;
									
									default: echo "Não Informado";
											
								}
							?>
						</div><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
					</div>
	
					<div id="cad-linha">
						<div id="nome_campo_solicitante">E-Mail:
						</div>
						<div id="conteudo_campo_solicitante">
							<?php echo $linha_usuario['email']; ?>
						</div>					
						<hr class="est1" style="margin-top:25px;margin-bottom:8px;">
					</div>
					<div id="cad-linha">
						<div id="nome_campo_solicitante">Sobre:</div>
						<div id="conteudo_campo_solicitante">
							<?php 
								if($linha_usuario['sobre']!=null&&$linha_usuario['sobre']!="")
									echo $linha_usuario['sobre']; 
								else
									echo "Nada Informado";
							?>
						</div><hr class="est1" style="margin-top:25px;margin-bottom:8px;">
					</div>
					<div id="cad-linha">
						<div id="nome_campo_solicitante">Website:</div>
						<div id="conteudo_campo_solicitante">
							<?php 
								if($linha_usuario['link_user']!=null&&$linha_usuario['link_user']!="")
									echo "<a href='".$linha_usuario['link_user']."' target='_BLANK'>".$linha_usuario['link_user']."</a>"; 
								else
									echo "Não Informado";
							?>
						</div>
					</div>
				</div>
			</div>
		<?php }
		
			if($linha_inst['excluido']=='e')
			{
		?>
			<div id="cad-ambos" style="background-color:transparent;min-width:800px;max-width:960px;width:800px;float:left;margin-bottom:10px;margin-top:10px;">
				<h4><b>Motivo para a Não Aprovação da Solicitação de Cadastro</b></h4>
				<div style="background-color:transparent;width:500px;float:left;border:1px solid #D8D8D8;border-radius:2px;padding:10px;text-align:justify">
					<?php 
						if($linha_inst['justificativa_exc']!=NULL&&$linha_inst['justificativa_exc']!="")
						{
							echo $linha_inst['justificativa_exc'];
						}
						else
						{
							echo "Não Informado";
						}
					?> 
				</div>
			</div>
		<?php 
			}
		?>
		
		<form style="display:inline;">
					<input type="hidden" name="id_inst" value="<?php echo $linha_inst['id_inst']; ?>">
					<input type="hidden" id="nome_inst" name="nome_inst" value="<?php echo $linha_inst['nome_inst']; ?>">
					<input type="hidden" id="avatar_inst_txt" name="avatar_inst_txt" value="<?php echo $linha_inst['avatar_inst']; ?>">
					<input type="hidden" id="img_modo" name="img_modo" value="<?php echo $linha_inst['avatar_inst']; ?>">
			
				<div style="float:left;margin-top:10px">
				<?php 
					if($linha_inst['excluido']=='a')
					{
				?>
						<input type="button" name="excluir" value="Excluir Solicitação" data-toggle="modal" data-target="#excluir_solicitacao">
						
						<input type="button" name="aprovar" value="Aprovar" data-toggle="modal" data-target="#confirmar_solicitacao">	
					
				<?php } ?>
					
				<?php 
					if($linha_inst['excluido']=='s')
					{
				?>
						<input type="button" name="ativar" value="Reativar Instituição"  data-toggle="modal" data-target="#ativar_instituicao">
				<?php } ?>
				</div>
			</form>
		</div>
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
	</div>
		
		<?php 
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
</body>
</html>