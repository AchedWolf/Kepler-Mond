<?php header('Content-Type: text/html; charset=UTF-8'); session_start(); ?> <html>
<!-- count -->
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
	
	<script type="text/javascript">
		function excluir_denuncia(id_den)
		{
			nome_inst=document.getElementById('nome_inst_'+id_den).value;
			document.getElementById('excluir_nome_instituicao').innerHTML="Deseja excluir a denúncia contra a Instituição de Ensino <b>"+nome_inst+"</b>?";
			document.getElementById('inst_excluir').value=id_den;
			
		}
		
		function limpar_pesquisa()
		{
			document.getElementById('denunciador').value="";
			document.getElementById('denunciado').value="";
			document.getElementById('motivo').value="Motivo";
			document.getElementById('descricao').value="";
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
		
		function alterarPagina(pagina)
		{
			document.getElementById('pagina').value=pagina;
			document.getElementById('pesquisa').submit();
		}
	</script>
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ ?>
			<a href="adm.php" title="Voltar ao Menu"><div id="icon-img" style="background-image: url('imagens/voltar.png');height:30px;margin-right:7px;float:left;margin-top:20px;"></div></a>
			<h2>Área do Administrador</h2><hr class="est1">
			<h3>Denúncias contra Instituições de Ensino</h3><br>
			<a href="adm-instituicoes.php">Visualizar Instituições de Ensino</a><br><br>
			<?php
			include "conecta.php";
			
			$nomes_instituicoes[]="";
			//$limite = 10;
			$limite = 4;
			$denuncias_pesquisa[]="";
			$flag_paginacao=0;
			$selecionado=" selected";
			$flag_denunciador=0;$flag_denunciado=0;$flag_descricao=0;$flag_motivo=0;
			
			# Se pg não existe atribui 1 a variável pg
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
			
			//Dados das Instituições de Ensino
			$consulta_instituicao = $db->prepare('SELECT * FROM instituicao');
			$consulta_instituicao->execute();
			while($linha_inst = $consulta_instituicao->fetch(PDO::FETCH_OBJ))
			{
				$nomes_instituicoes[$linha_inst->id_inst]=$linha_inst->nome_inst;
			}
			
			
			if(ISSET($_POST['denunciador']))
			{
				if($_POST['denunciador']!=null&&$_POST['denunciador']!="")
				{
					$denunciador="%".$_POST['denunciador']."%" ;
					$flag_denunciador=1;	
					$sql_parametros.=" AND login_den LIKE ? ";
				}	
			}
			
			if(ISSET($_POST['denunciado']))
			{
				if($_POST['denunciado']!=null&&$_POST['denunciado']!="")
				{
					$denunciado=$_POST['denunciado'] ;
					$flag_denunciado=1;		
				}	
			}
			
			if(ISSET($_POST['motivo']))
			{
				if($_POST['motivo']!=null&&$_POST['motivo']!="")
				{
					$motivo=$_POST['motivo'];
					$flag_motivo=1;
					$sql_parametros.=" AND motivo_den=? ";	
				}
			
			}
			
			if(ISSET($_POST['descricao']))
			{
				if($_POST['descricao']!=null&&$_POST['descricao']!="")
				{
					$descricao="%".$_POST['descricao']."%" ;
					$flag_descricao=1;	
					$sql_parametros.=" AND descr_den LIKE ? ";	
				}	
			}
			
			//Denúncias contra Instituições de Ensino
			$tipo_denuncia="i"; $a=2;
			$sql="SELECT * FROM denuncias WHERE tipo_denunciado=? ".$sql_parametros." ORDER BY data_den DESC LIMIT ? OFFSET ?";
			$consulta = $db->prepare($sql);
			$consulta->bindParam(1,$tipo_denuncia,PDO::PARAM_STR);
			if($flag_denunciador==1)
			{
				$consulta->bindParam($a,$denunciador,PDO::PARAM_STR);
				$a++;
			}
			if($flag_motivo==1)
			{
				$consulta->bindParam($a,$motivo,PDO::PARAM_STR);
				$a++;
			}
			if($flag_descricao==1)
			{
				$consulta->bindParam($a,$descricao,PDO::PARAM_STR);
				$a++;
			}
			$consulta->bindParam($a,$limite,PDO::PARAM_INT);
			$a++;
			$consulta->bindParam($a,$inicio,PDO::PARAM_INT);
			$a++;
			$consulta->execute();
			
			$b=0;
			while($linha_denuncia=$consulta->fetch(PDO::FETCH_OBJ))
			{
				if($flag_denunciado==1)
				{
					if(stristr($nomes_instituicoes[$linha_denuncia->id_denunciado],$denunciado)!=FALSE)
					{
						$denuncias_pesquisa[$b]=$linha_denuncia;
					}
				}
				else
				{
					$denuncias_pesquisa[$b]=$linha_denuncia;
				}
				$b++;		
			}
			
			
			//Exibicao Denunciador
			$denunciador_total=$denunciador;
			$denunciador_parcial=substr($denunciador_total,1);
			$num_caracteres=strlen($denunciador_parcial);
			$denunciador=substr($denunciador_parcial,0,($num_caracteres-1));	
			
			//Exibicao Descrição
			$descricao_total=$descricao;
			$descricao_parcial=substr($descricao_total,1);
			$num_caracteres=strlen($descricao_parcial);
			$descricao=substr($descricao_parcial,0,($num_caracteres-1));	
			
			$num_linhas = $consulta->rowCount();
			?>
			<!--
			<div id="adm-pesq" style="float:left;border:1px solid #BDBDBD;border-radius:8px;padding:10px;margin-bottom:10px;width:960px">
				<form action="adm-inst-denuncias.php" method="post" id="pesquisa">
				
					<h4 style="margin-top:0px;font-weight:bold;">Pesquisar</h4>
			-->
					<!-- NOME DA TABELA -->
				<!--
					<input type="hidden" name="pesquisando" id="pesquisando" value="pesquisando">
					<input type="hidden" name="pagina" id="pagina" value="">
					<input type="text" name="denunciador" id="denunciador" style="margin-right:10px;height:32px;width:300px" placeholder="Nome do Denunciador contém..." value="<?php echo $denunciador;?>">
					<input type="text" name="denunciado" id="denunciado" style="margin-right:10px;height:32px;width:300px" placeholder="Nome do Denunciado contém..." value="<?php echo $denunciado;?>">
					
					<select name="motivo" id="motivo" class="cad" style="margin-right:10px;height:32px;width:200px;margin-top:10px" >
						<option selected disabled style="font-weight:bold">Motivo</option>		
						<option value="assedio" <?php if($motivo=="assedio"){echo $selecionado;} ?>>Assédio</option>
						<option value="perfil_ofensivo" <?php if($motivo=="perfil_ofensivo"){echo $selecionado;} ?>>Perfil Ofensivo</option>
						<option value="spam" <?php if($motivo=="spam"){echo $selecionado;} ?>>Spam/Flood</option>
						<option value="abuso_tele" <?php if($motivo=="abuso_tele"){echo $selecionado;} ?>>Abuso do Telescópio</option>
						<option value="perfil_falso" <?php if($motivo=="perfil_falso"){echo $selecionado;} ?>>Perfil Falso</option>
					</select>
					<br><br>
					<textarea name="descricao" id="descricao" type="text" style="margin-right:10px;height:32px;width:530px;height:70px" placeholder="Descrição contém..."><?php echo $descricao;?></textarea>
					
					<input type="image" src="imagens/search.png" title="Pesquisar" style="height:50px;width:50px;margin-left:10px;margin-top:15px;float:right;">
					<input type="image" src="imagens/nao.png" onClick="limpar_pesquisa()" title="Limpar" style="height:50px;width:50px;margin-left:5px;margin-top:15px;float:right;">
					
				</form>
			</div>
			-->
			<?php
			if($num_linhas < 1)
			{ ?>
				<!--Ocorreu um erro ao carregar os resultados. :(-->
				Não há denúncias contra Instituições de Ensino registradas. :(
			<?php }
			else
			{ ?>
			
			
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
				foreach($denuncias_pesquisa as $denuncia_pesquisa)
				{ ?>
					<tr style="border:1px solid;padding:5px;">
						<td style="border:1px solid;padding:5px;">
							<span style="color:#2E64FE;">
								<a href="perfil.php?userp=<?php echo $denuncia_pesquisa->login_den; ?>" style="color:#2E64FE;">
									<?php echo $denuncia_pesquisa->login_den; ?>
								</a>
							</span>
						</td>
						<td style="border:1px solid;padding:5px;">
							<span style="color:#DF0101;font-weight:bold;">
								<a href="instituicao.php?i=<?php echo $denuncia_pesquisa->id_denunciado ?>" style="color:#DF0101;font-weight:bold;">		
									<?php 
										echo $nomes_instituicoes[$denuncia_pesquisa->id_denunciado]; 
									?>
								</a>
							</span>
						</td>
						
						<td style="border:1px solid;padding:5px;width:120px;">
							<?php
							if($denuncia_pesquisa->motivo_den == "assedio"){ echo "Assédio"; }
							else if($denuncia_pesquisa->motivo_den == "perfil_ofensivo"){ echo "Perfil ofensivo"; }
							else if($denuncia_pesquisa->motivo_den == "spam"){ echo "Spam/Flood"; }
							else if($denuncia_pesquisa->motivo_den == "abuso_tele"){ echo "Abuso do telescópio."; }
							else if($denuncia_pesquisa->motivo_den == "perfil_falso"){ echo "Perfil falso."; }
							?>
						</td>
						<td style="border:1px solid;padding:5px;">
							<span><?php if($denuncia_pesquisa->descr_den!=null){echo ucfirst($denuncia_pesquisa->descr_den);} else{ echo "Não Informado.";} ?></span>
						</td>
						<td style="border:1px solid;padding:5px;">
							<?php echo $denuncia_pesquisa->data_den; ?>
						</td>
						<td style="border:0px solid;" width="40px">
							<a href="#aprovar<?php echo $denuncia_pesquisa->id_den; ?>" title="Aprovar" data-toggle="modal"><img src="imagens/sim.png"></a>
							<!-- Modal -->
							<div class="modal fade" id="aprovar<?php echo $denuncia_pesquisa->id_den; ?>"" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
													<?php echo $denuncia_pesquisa->login_den; ?>
													</div>
												</div>
												
												<div style="float:left;width:100%;background-color:white;border-color:0px;">
													<div style="background-color:white;width:100px;overflow:hidden;float:left;height:15px;">
													Denunciado:
													</div>
													<div style="background-color:white;width:150px;overflow:hidden;float:left;height:15px;">
													<?php echo $denuncia_pesquisa->id_denunciado; ?>
													</div>
												</div>
												
												<div style="float:left;width:100%;background-color:white;border-color:0px;">
													<div style="background-color:white;width:100px;overflow:hidden;float:left;height:15px;">
													Tipo:
													</div>
													<div style="background-color:white;width:150px;overflow:hidden;float:left;height:15px;">
													<?php if($denuncia_pesquisa->tipo_denunciado == 'u'){ echo "Usuário."; } else if($denuncia_pesquisa->tipo_denunciado == 'i'){ echo "Instituição."; } ?>
													</div>
												</div>
												
												<div style="float:left;width:100%;background-color:white;border-color:0px;">
													<div style="background-color:white;width:100px;overflow:hidden;float:left;height:15px;">
													Motivo:
													</div>
													<div style="background-color:white;width:150px;overflow:hidden;float:left;height:15px;">
													<?php
													if($denuncia_pesquisa->motivo_den == "assedio"){ echo "Assédio"; }
													else if($denuncia_pesquisa->motivo_den == "perfil_ofensivo"){ echo "Perfil ofensivo"; }
													else if($denuncia_pesquisa->motivo_den == "spam"){ echo "Spam/Flood"; }
													else if($denuncia_pesquisa->motivo_den == "abuso_tele"){ echo "Abuso do telescópio."; }
													else if($denuncia_pesquisa->motivo_den == "perfil_falso"){ echo "Perfil falso."; }
													else if($denuncia_pesquisa->motivo_den == "outro"){ echo "Outro."; }
													?>
													</div>
												</div>
												
												<div style="float:left;width:100%;background-color:white;border-color:0px;">
													<div style="background-color:white;width:100px;overflow:hidden;float:left;height:15px;">
													Descrição:
													</div>
													<div style="background-color:white;width:150px;overflow:hidden;float:left;height:15px;">
													<?php echo $denuncia_pesquisa->descr_den; ?>
													</div>
												</div>
												
												<div style="float:left;width:100%;background-color:white;border-color:0px;">
													<div style="background-color:white;width:100px;overflow:hidden;float:left;height:15px;">
													Data:
													</div>
													<div style="background-color:white;width:150px;overflow:hidden;float:left;height:15px;">
													<?php echo $denuncia_pesquisa->data_den; ?>
													</div>
												</div>
											</div>
											
											<?php if($denuncia_pesquisa->tipo_denunciado == 'i'){ echo "A instituição"; } else if($denuncia_pesquisa->tipo_denunciado == 'u'){ echo "O usuário"; } ?> de nome <?php echo $linha->id_denunciado; ?> receberá um banimento até:
											<br>
											
											<form action="adm-denuncias_aprov.php" method="post">
												<input type="hidden" name="id_denunciado" value="<?php echo $denuncia_pesquisa->id_denunciado; ?>">
												<input type="hidden" name="login_den" value="<?php echo $denuncia_pesquisa->login_den; ?>">
												<input type="hidden" name="tipo_denunciado" value="<?php echo $denuncia_pesquisa->tipo_denunciado; ?>">
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
							<a href="" title="Excluir" data-toggle="modal" data-target="#excluir_denuncia" onclick="excluir_denuncia(<?php echo $denuncia_pesquisa->id_den; ?>)"><img src="imagens/nao.png"></a>
								
							<div class="modal fade" id="excluir_denuncia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-body" style="color:black;">
												<form action="adm-denuncias_exc.php?id_den=<?php echo $denuncia_pesquisa->id_den; ?>" method="post" >
													<h3 style="margin-top:-3px;">Excluir Denúncia</h3>
													
													<div id="excluir_nome_instituicao"></div><br>
													<div id="excluir_nome_instituicao_confirmacao"><b>Essa ação não poderá ser desfeita.</b></div>
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
						</td>
					</tr>
					<form>
						<input type="hidden" name="nome_inst" id="nome_inst_<?php echo $denuncia_pesquisa->id_den ?>" value="<?php echo $nomes_instituicoes[$denuncia_pesquisa->id_denunciado]; ?>">
						
					</form>
				<?php 
				} ?>
			</table>
			<?php 
				$parametro="";
				if(ISSET($_POST['pesquisando']))
				{
					if($_POST['pesquisando']!=null)
						$flag_pesquisa=1;
				}
				
				$a=2;
				$sql_Total = "SELECT * FROM denuncias WHERE tipo_denunciado=? ".$sql_parametros;
				$query_Total = $db->prepare($sql_Total);
				$query_Total->bindParam(1,$tipo_denuncia,PDO::PARAM_STR);
				if($flag_denunciador==1)
				{
					$denunciador_formatado="%".$denunciador."%";
					$query_Total->bindParam($a,$denunciador_formatado,PDO::PARAM_STR);
					$a++;
				}
				if($flag_motivo==1)
				{
					$query_Total->bindParam($a,$motivo,PDO::PARAM_STR);
					$a++;
				}
				if($flag_descricao==1)
				{
					$descricao_formatado="%".$descricao."%";
					$query_Total->bindParam($a,$descricao,PDO::PARAM_STR);
					$a++;
				}
				$query_Total->execute();
				//$query_result = $query_Total->fetchAll(PDO::FETCH_ASSOC);
				
				$b=0;$total_denuncias_pesquisa[]="";
				while($linha_result=$query_Total->fetch(PDO::FETCH_OBJ))
				{
					if($flag_denunciado==1)
					{
						if(stristr($nomes_instituicoes[$linha_result->id_denunciado],$denunciado)!=FALSE)
						{
							$total_denuncias_pesquisa[$b]=$linha_result;
						}
					}
					else
					{
						$total_denuncias_pesquisa[$b]=$linha_result;
					}
					$b++;		
				}
				
				# conta quantos registros tem no banco de dados
				//$query_count =  $query_Total->rowCount(PDO::FETCH_ASSOC);
				$query_count =  count($total_denuncias_pesquisa);
				# calcula o total de paginas a serem exibidas
				$qtdPag = ceil($query_count/$limite);
				//echo $query_count."/".$qtdPag."<br>";
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
									echo "<center> <br><a class='anterior' href='adm-inst-denuncias.php?pg=$pgAnt'>Anterior</a> ";

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
											echo "<a href='adm-inst-denuncias.php?pg=$i'>".$i."</a> ";
									}
								}
							}		
							if($pg!=$qtdPag)
							{
								$pgProx=$pg+1;
								if($flag_pesquisa==1)
									echo "<button class='proxima' id='paginacao_proximo' onClick='alterarPagina(".$pgProx.")' style='border:none;background-color:transparent' onMouseOver='paginacao_pesquisa_proximo()' onMouseOut='retorno_paginacao_pesquisa_proximo()'>Próxima</button> ";
								else
									echo "<a class='proxima' href='adm-inst-denuncias.php?pg=$pgProx'>Próxima</a>";
							}					
							echo "</center>";
						}
						
			} ?>
			
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