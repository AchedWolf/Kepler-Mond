<?php session_start(); ?> <html>
<head>
	<link href='css/estilo23.css' rel='stylesheet' type='text/css'>
	<link href='css/estilo6.css' rel='stylesheet' type='text/css'>
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
	<div id="fixo1">
		<div id="logo"><a href="index.php"><img src="imagens/logo.png" height="40px" style="margin-top:5px;margin-bottom:8px;" class="giro"></a></div>

		<!--INICIO - DROPDOWN SOBRE-->
		<!--<ul class="nav navbar-nav">
			<li class="dropdown">
				<button type="button" class="dropdown-toggle" data-toggle="dropdown" style="height:46px;color:white;background-color:black;border:1px solid black;font-size:15px;margin-left:-40px;">
					Sobre <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" style="margin-left:-37px;">
					<li><a href="sobre-geral.php">Geral</a></li>
					<li><a href="sobre-contato.php">Contato</a></li>
				</ul>
			</li>
		</ul>-->
		<!--FIM - DROPDOWN SOBRE-->

		<div id="botao-bf">
			<a href="sobre-geral.php" class="botao-bft">Sobre</a>
		</div>

		<div id="botao-bf">
			<a href="agendamento.php" class="botao-bft">Agendar</a>
		</div>

		<div id="botao-bf">
			<a href="ajuda.php" class="botao-bft">Ajuda</a>
		</div>

		<div id="botao-bf">
			<a href="videos.php" class="botao-bft">Vídeos</a>
		</div>

		<div id="fixo1-dir" style="font-family: 'Raleway', sans-serif;background-color:black;display: table-cell;vertical-align: middle;
		position:relative;color:white;float:right;margin-top:4px;margin-right:110px;min-width:180px;max-width:270px;
		min-height:47px;max-height:47px;text-align:right;word-wrap:inherit;">
			<?php if($_SESSION['logado'] == 1){ ?>
			<a href="perfil.php?userp=<?php echo $_SESSION['login']; ?>" style="word-wrap:inherit;display:inline;">
				<font style="height:10px;max-height:10px;background-color:transparent;color:white;border:0px;min-width:137px;
				max-width:227px;text-align:right;margin-top:10px;word-wrap:inherit;margin-right:2px;" height="10px"><?php echo $_SESSION['nome']; ?></font>

				<img src='<?php echo $_SESSION['avatar']; ?>' style="margin-top:0px; height:40px; width:40px; border: 1px solid black;
				margin-right:2px; align:center; cursor:pointer;border-radius:100px;">
			</a>

			<!--INICIO - DROPDOWN DIREITA-->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<button type="button" class="dropdown-toggle" data-toggle="dropdown" style="height:46px;background-color:black;border:1px solid black;font-size:15px;">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
					<?php if($_SESSION['tipo'] == 1) { ?>
						<li><a style="color:orange" href="adm.php">Área do<br>Administrador</a></li>
						<li class="divider"></li>
					<?php } ?>
						<li><a href="perfil.php?userp=<?php echo $_SESSION['login']; ?>">Ver Perfil</a></li>
						<li><a href="instituicoes.php?userp=<?php echo $_SESSION['login']; ?>">Instituições</a></li>
						<li class="divider"></li>
						<li><a href="livestream.php">Streaming <b><font color="red" size="1px">AO VIVO</font></b></a></li>
						<li class="divider"></li>
						<li><a href="config.php">Configurações</a></li>
						<li class="divider"></li>
						<li><a href="logout.php">Sair</a></li>
					</ul>
				</li>
			 </ul>
			 <!--FIM - DROPDOWN DIREITA-->
			 <?php }

			 else{ ?>
				 <div id="botao-bf" style="float:right;text-align:right;margin-top:-4px;">
					<a href="login.php" class="botao-bft">Login</a>
				</div>
			 <?php } ?>
		</div>

	</div><br><br><br><br>

		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:red;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ ?>
			<a href="adm.php" title="Voltar ao Menu"><div id="icon-img" style="background-image: url('imagens/voltar.png');height:30px;margin-right:7px;float:left;margin-top:20px;"></div></a>
			<h2>Área do Administrador</h2><hr class="est1">
			<!-- INICIO - VIDEO POPUP -->
			<a href="#primary" data-toggle="modal" class="btn btn-primary btn3d" style="width:140px;color:white;margin-bottom:10px;margin-top:-2px;">Inserir</a>
			<!-- Modal -->
			<div class="modal fade" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body" style="color:black;">
							<form action="videos-enviar.php" method="post">
							<input type="text" name="nome-est" style="width:565px;" placeholder="Nome da estrela" required><br><br>
							<textarea rows="10" cols="88" name="desc" id="desc" style="width:565px;padding:5px;resize:vertical;display:initial;margin-bottom:10px;" placeholder="Insira uma descrição para seu vídeo..." maxlength="300"></textarea>

							<input type="text" name="link" id="link" style="width:565px;" placeholder="ID do Vídeo no Youtube" OnChange="elink()" required><br><br>
							<input type="hidden" id="linkyoutube1" name="linkyoutube1">

							Preview:<br>
							<iframe width="560" height="315" src="https://www.youtube.com/embed/?rel=0" frameborder="0" id="ytlink" style="border:1px solid black;width:560px;height:315px;" allowfullscreen></iframe>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
							<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Salvar">
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- FIM - VIDEO POPUP -->
				<div id="adm-pesq" style="float:left;border:1px solid #BDBDBD;border-radius:8px;padding:10px;margin-bottom:10px;width:960px;">
					<form action="adm-videos.php" method="post">

					<input type="image" src="imagens/search.png" style="height:55px;width:55px;margin-left:7px;float:right;">
					<h4 style="margin-top:0px;font-weight:bold;">Pesquisar</h4>
					<!-- NOME DA TABELA -->
					<input name="tabela" type="hidden" value="videos">

					<input name="id" type="text" style="margin-right:10px;height:32px;width:45px;" placeholder="ID">

					<input name="titulo" type="text" style="margin-right:10px;height:32px;width:500px" placeholder="Título contém...">

					<select name="destaque" style="padding:5px;height:32px;margin-right:10px;">
						<option selected disabled style="font-weight:bold">Destaque</option>
						<option value="1">Sim</option>
						<option value="2">Não</option>
					</select>

					<select name="status" style="padding:5px;height:32px;">
						<option selected disabled style="font-weight:bold">Status</option>
						<option value="n">Ativo</option>
						<option value="s">Excluído</option>
					</select>

					</form>
				</div>

			<?php
			include "conecta.php";

			$nome=$_POST['nome'];
			$id=$_POST['id'];
			$descr=$_POST['descr'];
			$status=$_POST['status'];

			$titulo = strtolower($titulo);

			$sql="SELECT * FROM estrela WHERE nome iLIKE '%".$nome."%' OR descr iLike '%".$descr."%'";

			if($id>0)
			{
				$sql=$sql." AND id_estrela=".$id;
			}
			if(!empty($status))
			{
			$sql=$sql."  AND  excluido='".$status."'";
			}
			$sql=$sql." ORDER BY id_estrela";



			$consulta = $db->prepare($sql);
			$consulta->execute();

			$num_linhas = $consulta->rowCount();

			if($num_linhas < 1)
			{ ?>
				<br>Nenhum resultado encontrado.
			<?php }
			else
			{
				if($_GET['pesq'] == NULL){ ?>

				<!-- TABELA - td = resultado; th = titulo -->
				<table style="border:1px solid;padding:5px;font-size:13px;width:960px; table-layout: fixed;">
					<tr style="border:1px solid;padding:5px;background-color:#F2F2F2;">
						<th style="border:1px solid;padding:5px;width:60px;">
							Status
						</th>
						<th style="border:1px solid;padding:5px;width:25px;">
							ID
						</th>
						<th style="border:1px solid;padding:5px;width:140px;">
							Título
						</th>
						<th style="border:1px solid;padding:5px;width:340px;">
							Descrição
						</th>
						<th style="border:1px solid;padding:5px;width:80px;">
							Data<br>Horário
						</th>
						<th style="border:1px solid;padding:5px;width:45px;">
							Views
						</th>
						<th style="border:1px solid;padding:5px;width:100px;">
							ID YouTube
						</th>
						<th style="border:1px solid;padding:5px;width:70px;">
							Destaque
						</th>
					</tr>
					<?php
					while($linha = $consulta->fetch(PDO::FETCH_OBJ))
					{
						?><tr style="border:0px ;padding:5px;">
							<td style="border:1px solid;padding:5px;">
								<?php if($linha->excluido == 'n'){ echo "<font color='green'>Ativo</font>"; } else{ echo "<font color='red'>Excluído</font>";; } ?>
							</td>
							<td style="border:1px solid;padding:5px;">
								<center><?php echo $linha->id_estrela; ?></center>
							</td>
							<td style="border:1px solid;padding:5px;">
								<?php echo $linha->nome; ?>
							</td>
							<td id="desc-<?php echo $linha->id_video; ?>"  style="border:1px solid;padding:5px;overflow: hidden;text-overflow: ellipsis; white-space: nowrap;" title="<?php echo $linha->descr; ?>">
								<?php echo $linha->descr; ?>
							</td>
							<td style="border:1px solid;padding:5px;">
								<?php echo $linha->data_pub." às ".$linha->horario; ?>
							</td>
							<td style="border:1px solid;padding:5px;">
								<center><?php echo $linha->views; ?></center>
							</td>
							<td id="ytlink-<?php echo $linha->id_video; ?>" style="border:1px solid;padding:5px;">
								<a href="https://www.youtube.com/watch?v=<?php echo $linha->ytlink; ?>"  target="_blank"><?php echo $linha->ytlink; ?></a>
							</td>
							<td style="border:1px solid;padding:5px;">
								<?php if($linha->destaque == 1){ echo "<b>Sim</b>"; } else{ echo "Não"; } ?>
							</td>
							<td style="border:1px solid;padding:5px;" >
								<a href="editar-videos?id_video=<?php echo $linha->id_video; ?>" data-toggle="modal" title="Editar Dados"><img src="imagens/config2.png"></a>
							</td>
							<td style="border:1px solid;padding:5px;" >
								<a href="adm-exclui?id_video=<?php echo $linha->id_video; ?>" title="Excluir Permanentemente"><img src="imagens/delete.png"></a>
							</td>
						</tr>
						<?php
					} ?>
			</table>
			<?php
				}
				else{
					$id_video = $_POST['id_video'];
					$nome = $_POST['nome'];
					$desc = $_POST['desc'];
					$destaque = $_POST['destaque'];
					$excluido = $_POST['excluido']; ?>

					<!-- TABELA - td = resultado; th = titulo -->
					<table style="border:1px solid;padding:5px;font-size:13px;width:960px;">
					<tr style="border:1px solid;padding:5px;background-color:#F2F2F2;">
						<th style="border:1px solid;padding:5px;">
							Status
						</th>
						<th style="border:1px solid;padding:5px;">
							ID
						</th>
						<th style="border:1px solid;padding:5px;">
							Título
						</th>
						<th style="border:1px solid;padding:5px;">
							Descrição
						</th>
						<th style="border:1px solid;padding:5px;">
							Data/Horário
						</th>
						<th style="border:1px solid;padding:5px;">
							Visualizações
						</th>
						<th style="border:1px solid;padding:5px;">
							ID YouTube
						</th>
						<th style="border:1px solid;padding:5px;">
							Destaque
						</th>
					</tr>
					<?php
					while($linha = $consulta->fetch(PDO::FETCH_OBJ))
					{
						?><tr style="border:1px solid;padding:5px;">
							<td style="border:1px solid;padding:5px;">
								<?php if($linha->excluido == 'n'){ echo "<font color='green'>Ativo</font>"; } else{ echo "<font color='red'>Excluído</font>";; } ?>
							</td>
							<td style="border:1px solid;padding:5px;">
								<center><?php echo $linha->id_video; ?></center>
							</td>
							<td style="border:1px solid;padding:5px;">
								<?php echo $linha->nome; ?>
							</td>
							<td style="border:1px solid;padding:5px;">
								<?php echo $linha->desc; ?>
							</td>
							<td style="border:1px solid;padding:5px;">
								<?php echo $linha->data_pub." às ".$linha->horario; ?>
							</td>
							<td style="border:1px solid;padding:5px;">
								<center><?php echo $linha->views; ?></center>
							</td>
							<td style="border:1px solid;padding:5px;">
								<a href="https://www.youtube.com/watch?v=<?php echo $linha->ytlink; ?>" target="_blank"><?php echo $linha->ytlink; ?></a>
							</td>
							<td style="border:1px solid;padding:5px;">
								<?php if($linha->destaque == 1){ echo "<b>Sim</b>"; } else{ echo "Não"; } ?>
							</td>
							<td style="border:1px solid;" width="30px">
								<a href="#" title="Editar Dados"><img src="imagens/config2.png"></a>
							</td>
							<td style="border:1px solid;" width="30px">
								<a href="#" title="Excluir Permanentemente"><img src="imagens/delete.png"></a>
							</td>
						</tr>
						<?php
					} ?>
					</table>
					<?php
				}
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

	</div> <!-- Rodapé - INICIO -->
	<div id="rodape">
		<b><div id="icon-img" style="background-image: url('imagens/mapa.png");height:20px;"></div>Mapa do Site</b><br>
		<div id="rod-col">
			<a href="index.php" id="link1">Início</a><br>
			<a href="agendamento.php" id="link2">Agendamento</a><br>
			<a href="sobre-geral.php" id="link3">Sobre</a><br>
		</div>
		<div id="rod-col">
			<a href="ajuda.php" id="link4">Ajuda</a><br>
			<a href="videos.php" id="link5">Vídeos</a><br>
			<a href="livestream.php" id="link6">Stream</a><br>
		</div>
		<div id="rod-col">
			<a href="#" id="link7">LINK</a><br>
			<a href="#" id="link8">LINK</a><br>
			<a href="#" id="link9">LINK</a><br>
		</div>
		<br><br><br><br>
		<a href="http://facebook.com"><div id="rod-social" style="background-image: url('imagens/facebook.png");" title="Facebook"></div></a>
		<a href="http://twitter.com"><div id="rod-social" style="background-image: url('imagens/twitter.png");" title="Twitter"></div></a>
		<a href="http://youtube.com"><div id="rod-social" style="background-image: url('imagens/youtube.png");" title="YouTube"></div></a>
	</div>
	<!-- Rodapé - FIM -->
</html>
</body>