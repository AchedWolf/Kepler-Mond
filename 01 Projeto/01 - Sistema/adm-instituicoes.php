<?php header('Content-Type: text/html; charset=UTF-8'); session_start(); ?> <html>
<head>
	<link href='css/estilo23.css' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<link rel="stylesheet" href="/resources/demos/style.css">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<script>
	
	
 	 $( function() {
   	 $("#datepicker").datepicker({
						dateFormat: 'dd/mm/yy',
						changeMonth: true,
						changeYear: true,
						yearRange: "-500:+0"
					
						});
	 $("#datepicker").mask("99/99/9999");
  		} );
	</script>
	
	<link rel="icon" href="imagens/logomarca.png">
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
	<title>Kepler</title>
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php 
			include "cabecalho.php"; 
			include "conecta.php";
			//Administradores
			$consulta_admin = $db->prepare("SELECT * FROM usuario WHERE tipo=1");
			$consulta_admin->execute();
			
			$consulta_admin_inst = $db->prepare("SELECT * FROM relacao WHERE tipo=3");
			$consulta_admin_inst->execute();
			$linha_admin_inst=$consulta_admin_inst->fetch(PDO::FETCH_ASSOC);
			
	?>
		
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
				
				function exclusao_aprovada(id_inst)
				{
					var nome_inst=document.getElementById('nome_inst_'+id_inst).value;
					document.getElementById('inst_excluir_aprovada').value=id_inst;
					document.getElementById('excluir_nome_instituicao_aprovada').innerHTML="Deseja excluir a Instituição de Ensino  <b>"+nome_inst+"</b>?";
				}
				
				function denunciar_inst(id_inst)
				{
					var nome_inst=document.getElementById('nome_inst_'+id_inst).value;
					document.getElementById('id_denunciado').value=id_inst;
					document.getElementById('denunciar_nome_instituicao').innerHTML="Você está denunciando a instituição  <b>"+nome_inst+"</b>.";
				}
				
				function limpar_pesquisa()
				{
					document.getElementById('nome').value="";
					document.getElementById('email').value="";
					document.getElementById('cidade').value="";
					document.getElementById('estado').value="Estado";
					document.getElementById('situacao').value="Situação";
					document.getElementById('pesquisando').value="";
					document.getElementById('pesquisa').submit();
				
				}
				
				function paginacao_pesquisa_anterior()
				{
					document.getElementById('paginacao_anterior').style.color="#0000FF";
				}
				
				function retorno_paginacao_pesquisa_anterior()
				{
					document.getElementById('paginacao_anterior').style.color="black";
				}
				
				function paginacao_pesquisa_paginas(pagina)
				{
					document.getElementById('paginacao_paginas_'+pagina).style.color="#0000FF";
				}
				function retorno_paginacao_pesquisa_paginas(pagina)
				{
					document.getElementById('paginacao_paginas_'+pagina).style.color="black";
				}
				function paginacao_pesquisa_proximo()
				{
					document.getElementById('paginacao_proximo').style.color="#0000FF";
				}
				
				function retorno_paginacao_pesquisa_proximo()
				{
					document.getElementById('paginacao_proximo').style.color="black";
				}
				
		</script> 
		
		<!-- Alteração Administrador Instituição -->
			<div class="modal fade" id="configurar_envio_notificacoes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body" style="color:black;">
							<form action="config_notificacao_adm_inst.php" method="post" >
								<h3 style="margin-top:-3px;">Configurações de Envio de Notificações</h3>
								
								<b>Administrador responsável por receber notificações referentes às Instituições de Ensino:</b>
								<br><br>
								<select name="adm_envio_notificacao">
									<?php 
										while($linha_admin = $consulta_admin->fetch(PDO::FETCH_OBJ))
										{
									?>
											<option value="<?php echo $linha_admin->login; ?>" <?php if($linha_admin->login==$linha_admin_inst['login']){echo "selected";} ?>> 
												<?php echo $linha_admin->login; ?>
											</option>
									<?php 
										}
									?>
								</select>
						</div>
						<div class="modal-footer">
									<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
									<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Alterar">
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		
	
		
		<!-- Mensagens de Confirmação -->
			<div class="modal fade" id="denunciar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body" style="color:black;">
							<form action="denuncia-enviar.php" method="post" >
						
								<h3 style="margin-top:-3px;">Denunciar</h3>
								
								<div id="denunciar_nome_instituicao"></div>
								<br>
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
								<input type="hidden" name="id_denunciado" id="id_denunciado" value="">
								<input type="hidden" name="adm" id="adm" value="">
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
		<!-- FIM - DENUNCIAR POPUP -->
		
			<div class="modal fade" id="confirmar_solicitacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body" style="color:black;">
							<form action="adm_aprovar_inst.php" method="post" >
								<input type="hidden" name="inst_aprovar" id="inst_aprovar" value="">
								<h3 style="margin-top:-3px;">Aprovar Solicitação de Cadastro</h3>
								
								<div id="aprovar_nome_instituicao"></div>
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
		
			<div class="modal fade" id="excluir_solicitacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body" style="color:black;">
							<form action="adm_excluir_inst.php" method="post" >
								<input type="hidden" name="inst_excluir" id="inst_excluir" value="">
								<h3 style="margin-top:-3px;">Excluir Solicitação de Cadastro</h3>
								
								<div id="excluir_nome_instituicao"></div>
								<br>
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
		
		
			<div class="modal fade" id="excluir_instituicao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body" style="color:black;">
							<form action="adm_excluir_inst.php" method="post" >
								<input type="hidden" name="inst_excluir_aprovada" id="inst_excluir_aprovada" value="">
								<input type="hidden" name="aprovada" id="aprovada" value="">
								<h3 style="margin-top:-3px;">Excluir Instituição de Ensino</h3>
								
								<div id="excluir_nome_instituicao_aprovada"></div>
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
		
			<div class="modal fade" id="ativar_instituicao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body" style="color:black;">
							<form action="adm_aprovar_inst.php" method="post" >
								<input type="hidden" name="inst_ativar" id="inst_ativar" value="">
								<input type="hidden" name="ativar" id="ativar" value="">
								<h3 style="margin-top:-3px;">Aprovar Solicitação de Cadastro</h3>
								
								<div id="ativar_nome_instituicao"></div>
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
		
	
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ 
		?>
			<a href="adm.php" title="Voltar ao Menu"><div id="icon-img" style="background-image: url('imagens/voltar.png');height:30px;margin-right:7px;float:left;margin-top:20px;"></div></a>
			<h2>Área do Administrador <a href="" data-toggle="modal" data-target="#configurar_envio_notificacoes"><img src="imagens/config.png" style="float:right;" title="Configurar Envio de Notificações"></a></h2><hr class="est1">
		
			<?php
			
			$limite = 10;
			//$limite = 6;
			$flag_inicio=0;
			$flag_paginacao=0;
			$flag_nome=0;$flag_email=0;$flag_cidade=0;$flag_estado=0;$flag_situacao=0;$flag_pesquisa=0;
			$selecionado=" selected";
		
			if(ISSET($_GET['pg']))
			{
				if($_GET['pg']!=null)
					$pg=$_GET['pg'];
				else
					$pg=1;
			}
			else if(ISSET($_POST['pagina']))
			{
				if($_POST['pagina']!=null)
					$pg=$_POST['pagina'];
				else
					$pg=1;
			}
			else
			{
				$pg=1;
			}
			
			
			# Atribui a variável inicio o inicio de onde os registros vão ser
			# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
			$inicio = ($pg * $limite) - $limite;
			
			//Instituição
			$sql="SELECT * FROM instituicao";
			$sql_parametros="";

			//Nome, Email, Cidade, Estado, Situação
			$nome="";$email="";$cidade="";$estado="";$situacao="";
			
			if(ISSET($_POST['nome']))
			{
				if($_POST['nome']!=null&&$_POST['nome']!="")
				{
					$nome="%".$_POST['nome']."%" ;
					$flag_nome=1;	
						
					if($flag_inicio!=1)
					{
						$flag_inicio=1;
						$sql_parametros.=" WHERE ";
					}
					else
					{	
						$sql_parametros.=" AND ";
					}	
					$sql_parametros.=" nome_inst LIKE ?";	
				}	
			}
				
			if(ISSET($_POST['email']))
			{
				if($_POST['email']!=null&&$_POST['email']!="")
				{
					$email="%".$_POST['email']."%";
					$flag_email=1;
					if($flag_inicio!=1)
					{
						$flag_inicio=1;
						$sql_parametros.=" WHERE ";
					}
					else
					{
						$sql_parametros.=" AND ";
					}	
					$sql_parametros.=" email_inst LIKE ? ";	
				}	
			}
			
			if(ISSET($_POST['cidade']))
			{
				if($_POST['cidade']!=null&&$_POST['cidade']!="")
				{
					$cidade=$_POST['cidade'];
					$flag_cidade=1;
					if($flag_inicio!=1)
					{
						$flag_inicio=1;
						$sql_parametros.=" WHERE ";
					}
					else
					{
						$sql_parametros.=" AND ";
					}	
					$sql_parametros.=" cidade_inst=?";	
				}
			
			}
			
			if(ISSET($_POST['estado']))
			{
				$estado=$_POST['estado'];
				if($estado!=null&&$estado!="")
				{
					$flag_estado=1;
					if($flag_inicio!=1)
					{
						$flag_inicio=1;
						$sql_parametros.=" WHERE ";
					}
					else
					{
						$sql_parametros.=" AND ";
					}	
					$sql_parametros.=" estado_inst=?";	
				}
			} 
			
			if(ISSET($_POST['situacao']))
			{
				$situacao=$_POST['situacao'];
				if($situacao!=null&&$situacao!="")
				{
					$flag_situacao=1;
					if($flag_inicio!=1)
					{
						$flag_inicio=1;
						$sql_parametros.=" WHERE ";
					}
					else
					{
						$sql_parametros.=" AND ";
					}	
					$sql_parametros.=" excluido=?";	
				}
			}
			//Nome, Email, Cidade, Estado, Situação
			$sql.=$sql_parametros." ORDER BY nome_inst LIMIT ".$limite. "  OFFSET ". $inicio;
		
			$consulta_instituicao = $db->prepare($sql);
			
			$a=1;
			if($flag_nome==1)
			{
				$consulta_instituicao->bindParam($a,$nome,PDO::PARAM_STR);
				$a++;
			}
			if($flag_email==1)
			{
				$consulta_instituicao->bindParam($a,$email,PDO::PARAM_STR);
				$a++;
			}
			if($flag_cidade==1)
			{
				$consulta_instituicao->bindParam($a,$cidade,PDO::PARAM_STR);
				$a++;
			}
			if($flag_estado==1)
			{
				$consulta_instituicao->bindParam($a,$estado,PDO::PARAM_STR);
				$a++;
			}
			if($flag_situacao==1)
			{
				$consulta_instituicao->bindParam($a,$situacao,PDO::PARAM_STR);
			}
			$consulta_instituicao->execute();
			
			//Exibicao Nome
			$nome_total=$nome;
			$nome_parcial=substr($nome_total,1);
			$num_caracteres=strlen($nome_parcial);
			$nome=substr($nome_parcial,0,($num_caracteres-1));		
			
			//Exibição Email
			$email_total=$email;
			$email_parcial=substr($email_total,1);
			$num_caracteres=strlen($email_parcial);
			$email=substr($email_parcial,0,($num_caracteres-1));	
			
			$num_linhas_instituicao = $consulta_instituicao->rowCount();
	
		?>
		
		<script type="text/javascript">
			function alterarPagina(pagina)
			{
				document.getElementById('pagina').value=pagina;
				document.getElementById('pesquisa').submit();
			}
		</script>
	
			<div id="adm-pesq" style="float:left;border:1px solid #BDBDBD;border-radius:8px;padding:10px;margin-bottom:10px;width:960px">
				<form action="adm-instituicoes.php" method="post" id="pesquisa">
				
				<h4 style="margin-top:0px;font-weight:bold;">Pesquisar</h4>
				<!-- NOME DA TABELA -->
				<input name="nome" id="nome" type="text" style="margin-right:10px;height:32px;width:250px" placeholder="Nome da Instituição contém..." value="<?php echo $nome;?>">
				<input type="hidden" name="pesquisando" id="pesquisando" value="pesquisando">
				<input type="hidden" name="pagina" id="pagina" value="">
				<input name="email" id="email" type="text" style="margin-right:10px;height:32px;width:180px" placeholder="E-Mail" value="<?php echo $email;?>">
				<input name="cidade" id="cidade" type="text" style="margin-right:10px;height:32px;width:180px" placeholder="Cidade" value="<?php echo $cidade;?>">
				<select name="estado" id="estado" class="cad" style="margin-right:10px;height:32px;width:95px;" >
							<option selected disabled style="font-weight:bold">Estado</option>		
							<option value="AC" <?php if($estado=="AC"){echo $selecionado;} ?>>AC</option>
							<option value="AL" <?php if($estado=="AL"){echo $selecionado;} ?>>AL</option>
							<option value="AM" <?php if($estado=="AM"){echo $selecionado;} ?>>AM</option>
							<option value="AP" <?php if($estado=="AP"){echo $selecionado;} ?>>AP</option>						
							<option value="BA" <?php if($estado=="BA"){echo $selecionado;} ?>>BA</option>
							<option value="CE" <?php if($estado=="CE"){echo $selecionado;} ?>>CE</option>
							<option value="DF" <?php if($estado=="DF"){echo $selecionado;} ?>>DF</option>
							<option value="ES" <?php if($estado=="ES"){echo $selecionado;} ?>>ES</option>
							<option value="GO" <?php if($estado=="GO"){echo $selecionado;} ?>>GO</option>
							<option value="MA" <?php if($estado=="MA"){echo $selecionado;} ?>>MA</option>
							<option value="MG" <?php if($estado=="MG"){echo $selecionado;} ?>>MG</option>
							<option value="MS" <?php if($estado=="MS"){echo $selecionado;} ?>>MS</option>
							<option value="MT" <?php if($estado=="MT"){echo $selecionado;} ?>>MT</option>
							<option value="PA" <?php if($estado=="PA"){echo $selecionado;} ?>>PA</option>
							<option value="PB" <?php if($estado=="PB"){echo $selecionado;} ?>>PB</option>
							<option value="PE" <?php if($estado=="PE"){echo $selecionado;} ?>>PE</option>
							<option value="PI" <?php if($estado=="PI"){echo $selecionado;} ?>>PI</option>
							<option value="PR" <?php if($estado=="PR"){echo $selecionado;} ?>>PR</option>
							<option value="RJ" <?php if($estado=="RJ"){echo $selecionado;} ?>>RJ</option>
							<option value="RN" <?php if($estado=="RN"){echo $selecionado;} ?>>RN</option>						
							<option value="RO" <?php if($estado=="RO"){echo $selecionado;} ?>>RO</option>
							<option value="RR" <?php if($estado=="RR"){echo $selecionado;} ?>>RR</option>
							<option value="RS" <?php if($estado=="RS"){echo $selecionado;} ?>>RS</option>
							<option value="SC" <?php if($estado=="SC"){echo $selecionado;} ?>>SC</option>
							<option value="SE" <?php if($estado=="SE"){echo $selecionado;} ?>>SE</option>
							<option value="SP" <?php if($estado=="SP"){echo $selecionado;} ?>>SP</option>
							<option value="TO" <?php if($estado=="TO"){echo $selecionado;} ?>>TO</option>
						</select>
					
				
				<select name="situacao" class="cad" id="situacao" style="padding:5px;height:32px;margin-top:10px;margin-right:10px;">
					<option selected disabled style="font-weight:bold">Situa&ccedil;ão</option>
					<option value='e' <?php if($situacao=="e"){echo $selecionado;} ?>>Não Aprovado</option>
					<option value='a' <?php if($situacao=="a"){echo $selecionado;} ?>>Aguardando Aprovação</option>
					<option value='n' <?php if($situacao=="n"){echo $selecionado;} ?>>Ativo</option>
					<option value='s' <?php if($estado=="s"){echo $selecionado;} ?>>Excluído</option>
				</select>
						
				<br>
				<input type="image" src="imagens/search.png" title="Pesquisar" style="height:50px;width:50px;margin-left:10px;margin-top:25px;float:right;">
				<input type="image" src="imagens/nao.png" onClick="limpar_pesquisa()" title="Limpar" style="height:50px;width:50px;margin-left:5px;margin-top:25px;float:right;">
				
				</form>
			</div>
			<h3>Instituições de Ensino</h3>
		
			<a href="adm-inst-denuncias.php">Visualizar Denúncias</a>
			<br><br>
		<?php 

			if($num_linhas_instituicao < 1)
			{ 
		?>
				<label>Instituições de Ensino Não Encontradas.</label>
			<?php 
			}
			else
			{ 	
		?>
			<!-- TABELA - td = resultado; th = titulo -->
		
			<table style="border:1px solid;padding:5px;font-size:13px;width:960px;">
			
				<tr style="border:1px solid;padding:5px;background-color:#F2F2F2;">
					<th style="border:1px solid;padding:5px;">
						Situação
						
					</th>
					
					<th style="border:1px solid;padding:5px;">
						Nome da Instituiç&atilde;o
					</th>
				
					<th style="border:1px solid;padding:5px;">
						Cidade/Estado
					</th>
					
					<th style="border:1px solid;padding:5px;">
						E-Mail
					</th>
				</tr>
				<?php 
					
				while($linha_instituicao = $consulta_instituicao->fetch(PDO::FETCH_OBJ))
				{
					
				?><tr style="border:1px solid;padding:5px;">
						<!-- Situação -->
						<td style="border:1px solid;padding:5px;">
							<?php 
								switch($linha_instituicao->excluido)
								{
									case "a": echo "<label style='color:#FF4500'>Aguardando Aprovação</label>";
											break;
											
									case "e": echo "<label style='color:red'>Solicitação Não Aprovada</label>";
											break;
									
									case "n": echo "<label style='color:green'>Ativo</label>";
											break;
									
									case "s": echo "<label style='color:red'>Excluído</label>";
												break;		
								}
							?>
						</td>
						
						<!-- Nome da Instituição -->
						<td style="border:1px solid;padding:5px;">
							<?php echo $linha_instituicao->nome_inst; 
							?>
						</td>
					
						<!-- Cidade/Estado - Instituição -->
						<td style="border:1px solid;padding:5px;">
							<?php if($linha_instituicao->cidade_inst!=NULL  && $linha_instituicao->estado_inst!=NULL){ echo $linha_instituicao->cidade_inst.", ".$linha_instituicao->estado_inst; } else { echo "Não Informado."; } ?>
						</td>
						
						<!-- Email - Instituição -->
						<td style="border:1px solid;padding:5px;">
							<?php	
								echo $linha_instituicao->email_inst;	
							?>
						</td>
						
						<!-- Visualizar Dados da Instituição -->
						<td style="border:0px solid;" width="40px">
							
							<form>
								<input type="hidden" name="nome_inst_<?php echo $linha_instituicao->id_inst; ?>" id="nome_inst_<?php echo $linha_instituicao->id_inst; ?>" value="<?php echo $linha_instituicao->nome_inst; ?>">
							</form>
							<center>
								<?php if($linha_instituicao->excluido=='a'||$linha_instituicao->excluido=='s'||$linha_instituicao->excluido=='e'){ ?>
									<a href="adm_inst_visualizar_dados.php?i=<?php echo $linha_instituicao->id_inst; ?>" title="Visualizar Todos os Dados"><img src="imagens/visualizar_dados.png" width="23px" height="23px"></a>
								<?php }?>
								<?php if($linha_instituicao->excluido=='n'){ ?>
									<a href="instituicao.php?i=<?php echo $linha_instituicao->id_inst; ?>" title="Visualizar Perfil"><img src="imagens/visualizar_dados.png" width="23px" height="23px"></a>
								<?php }?>
							</center>	
						</td>
						
						<!-- Aprovar Solicitação de Cadastro - Denunciar Instituição -->
						<td style="border:0px solid;" width="40px">
						<center>
							<?php if($linha_instituicao->excluido=='a'){ ?>
									<a href="" title="Aprovar Solicitação de Cadastro" onClick="confirmacao('<?php echo $linha_instituicao->id_inst; ?>')" data-toggle="modal" data-target="#confirmar_solicitacao">
										<img src="imagens/sim.png">
									</a>							
							<?php }?>
						
							<?php // if($linha_instituicao->excluido=='n'){ ?>
								<!--	<a href="" onClick="denunciar_inst('<?php echo $linha_instituicao->id_inst; ?>')" title="Denunciar Instituição de Ensino" data-toggle="modal" data-target="#denunciar"><img src="imagens/nao.png"></a>
									-->
								</center>		
									
							<?php// }?>
					
						</td>
	
						<!-- Excluir ou Reativar -->
						<td style="border:0px solid;" width="40px">
							<?php if($linha_instituicao->excluido=='a'){ ?>
									<a href="" onClick="exclusao('<?php echo $linha_instituicao->id_inst; ?>')" title="Excluir Solicitação" data-toggle="modal" data-target="#excluir_solicitacao">
										<img src="imagens/delete.png">
									</a>
							<?php }?>
							<?php if($linha_instituicao->excluido=='n'){ ?>
									<a href="" onClick="exclusao_aprovada('<?php echo $linha_instituicao->id_inst; ?>')" title="Excluir Instituição de Ensino" data-toggle="modal" data-target="#excluir_instituicao"><img src="imagens/delete.png"></a>
							<?php }?>
							
							<?php if($linha_instituicao->excluido=='s'){ ?>
									<a href="" onClick="reativar_inst('<?php echo $linha_instituicao->id_inst; ?>')" title="Reativar Instituição de Ensino" data-toggle="modal" data-target="#ativar_instituicao"><img src="imagens/sim.png"></a>
							<?php }?>
							
						</td>
							
					
					</tr>
				<?php 
				} ?>
			</table>
		
			<br>
			<?php 
			} 
			$parametro="";
			if(ISSET($_POST['pesquisando']))
			{
				if($_POST['pesquisando']!=null)
					$flag_pesquisa=1;
			}
				
			$sql_Total = 'SELECT id_inst FROM instituicao '.$sql_parametros;
			$query_Total = $db->prepare($sql_Total);
			$a=1;
			if($flag_nome==1)
			{
				$nome_formatado="%".$nome."%";
				$query_Total->bindParam($a,$nome_formatado,PDO::PARAM_STR);
				$a++;
			}
			if($flag_email==1)
			{
				$email_formatado="%".$email."%";
				$query_Total->bindParam($a,$email_formatado,PDO::PARAM_STR);
				$a++;
			}
			if($flag_cidade==1)
			{
				$query_Total->bindParam($a,$cidade,PDO::PARAM_STR);
				$a++;
			}
			if($flag_estado==1)
			{
				$query_Total->bindParam($a,$estado,PDO::PARAM_STR);
				$a++;
			}
			if($flag_situacao==1)
			{
				$query_Total->bindParam($a,$situacao,PDO::PARAM_STR);
			}
			$query_Total->execute();
		
			$query_result = $query_Total->fetchAll(PDO::FETCH_ASSOC);
			
			# conta quantos registros tem no banco de dados
			$query_count =  $query_Total->rowCount(PDO::FETCH_ASSOC);
			# calcula o total de paginas a serem exibidas
			$qtdPag = ceil($query_count/$limite);
			# Cria os links para navegação das paginas
			echo "<div class='relax h30'></div>";
			# echo '<a href="busca?pg=1">PRIMEIRA PÁGINA</a>&nbsp;';
			echo '<ul id="paginacao">';
			if($qtdPag>1)
			{
				if($pg!=1)
				{
					$flag_paginacao=1;
					$pgAnt=$pg-1;
					if($flag_pesquisa==1)
						echo "<center> <br><button id='paginacao_anterior' class='anterior' onclick='alterarPagina(".$pgAnt.")' style='border:none;background-color:transparent' onMouseOver='paginacao_pesquisa_anterior()' onMouseOut='retorno_paginacao_pesquisa_anterior()' >Anterior</button> ";
					else
						echo "<center> <br><a class='anterior' href='adm-instituicoes.php?pg=$pgAnt'>Anterior</a> ";

				}

				if($qtdPag > 1 && $pg <= $qtdPag)
				{
					for($i = 1; $i <= $qtdPag; $i++)
					{
						if($i == $pg)
						{
							if($flag_paginacao==0)
							{
								echo "<center>";
								$flag_paginacao=1;
							}
							if($flag_pesquisa==1)
								echo " <button class='ativo' style='border:none;background-color:transparent;cursor:text;color:blue' disabled>".$i."</button> ";
							else
								echo " <a class='ativo'>".$i."</button> ";
							
						} 
						else 
						{
							if($flag_pesquisa==1)
								echo "<button id='paginacao_paginas_".$i."' onClick='alterarPagina(".$i.")' style='border:none;background-color:transparent' onMouseOver='paginacao_pesquisa_paginas(".$i.")'  onMouseOut='retorno_paginacao_pesquisa_paginas(".$i.")' >".$i."</button> ";
							else
								echo "<a href='adm-instituicoes.php?pg=$i'>".$i."</a> ";
						}
					}
				}		
				if($pg!=$qtdPag)
				{
					$pgProx=$pg+1;
					if($flag_pesquisa==1)
						echo "<button class='proxima' id='paginacao_proximo' onClick='alterarPagina(".$pgProx.")' style='border:none;background-color:transparent' onMouseOver='paginacao_pesquisa_proximo()' onMouseOut='retorno_paginacao_pesquisa_proximo()'>Próxima</button> ";
					else
						echo "<a class='proxima' href='adm-instituicoes.php?pg=$pgProx'>Próxima</a>";
				}					
				echo "</center>";
			}
		}
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
	</body>
</html>
