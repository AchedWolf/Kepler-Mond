<?php session_start(); ?> <html>
<head>
	<script src="js/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
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
	
	<?php include "cabecalho.php"; ?>

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
							<script>
							function elink()
							{
								var linkcomp = "https://www.youtube.com/embed/" + document.getElementById("link").value + "?rel=0";
								var linkwatch = "https://www.youtube.com/watch?v=" + document.getElementById("link").value;
								document.getElementById("linkyoutube1").value = linkwatch;
								document.getElementById("ytlink").src = linkcomp;
							}

							function desctipof()
							{
								if(document.getElementById("desctipo").selectedIndex == "0"){ //Customizada
									document.getElementById("desc").style = "width:565px;padding:5px;resize:vertical;display:initial;margin-bottom:10px;";
								}
								else if(document.getElementById("desctipo").selectedIndex == "1"){ //YouTube
									document.getElementById("desc").style = "width:565px;padding:5px;resize:vertical;display:none;margin-bottom:0px;";
								}
							}

							function deldestaque()
							{
								var res = confirm("Deseja remover este vídeo do destaque?");
								if(res == true) {
									window.location.href = "destaque-geral.php?acao=del";
								}
							}

							</script>

						<div class="modal-body" style="color:black;">
							<form action="videos-enviar.php" method="post">

							<select OnChange="desctipof()" id="desctipo" name="desctipo" style="padding:5px;">
								<option value="0">Descrição Customizada</option>
								<option value="1">Descrição do YouTube</option>
							</select><br><br>
							<textarea pattern="[a-zA-Z0-9 ]+" rows="10" cols="88" name="desc" id="desc" style="width:565px;padding:5px;resize:vertical;display:initial;margin-bottom:10px;" placeholder="Insira uma descrição para seu vídeo..." maxlength="300"></textarea>

							<input pattern="[a-zA-Z0-9_-]+" type="text" name="link" id="link" style="width:565px;" placeholder="ID do Vídeo no Youtube" OnChange="elink()" required><br><br>
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
			
				$limite = 10;
				
			# Se pg não existe atribui 1 a variável pg
			$pg = (isset($_GET['pg'])) ? (int)$_GET['pg'] : 1;

			# Atribui a variável inicio o inicio de onde os registros vão ser
			# mostrados por página, exemplo 0 à 10, 11 à 20 e assim por diante
			$inicio = ($pg * $limite) - $limite;
			
			$titulo=$_POST['titulo'];
			$id=$_POST['id'];
			$status=$_POST['status'];
			$destaque=$_POST['destaque'];

			$titulo = strtolower($titulo);

			$sql="SELECT * FROM videos WHERE nome iLIKE '%".$titulo."%'";

			if($id>0)
			{
				$sql=$sql." AND id_video=".$id;
			}
			if(!empty($status))
			{
			$sql=$sql."  AND  excluido='".$status."'";
			}
			if($destaque==1)
			{
			$sql=$sql."  AND  destaque=1";
			}
			else if($destaque==2)
			{
			$sql=$sql."  AND  destaque=0";
			}
			$sql=$sql." ORDER BY id_video LIMIT ".$limite. "  OFFSET ". $inicio;



			$consulta = $db->prepare($sql);
			$consulta->execute();

			$num_linhas = $consulta->rowCount();

			if($num_linhas < 1)
			{ ?>
				<br>Nenhum resultado encontrado.
			<?php }
			else
			{
				?>

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
						<th style="border:1px solid;padding:5px;width:80px;">
							Views
						</th>
						<th style="border:1px solid;padding:5px;width:100px;">
							ID YouTube
						</th>
						<th style="border:1px solid;padding:5px;width:39px;" title="Destaque">
							Dest.
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
								<center><?php echo $linha->id_video; ?></center>
							</td>
							<td id="titulo-<?php echo $linha->id_video;?>" style="border:1px solid;padding:5px;overflow: hidden;text-overflow: ellipsis; white-space: nowrap;"title="<?php echo $linha->nome; ?>">
								<?php echo $linha->nome; ?>
							</td>
							<?php $descricao=str_replace("<", " ",$linha->descr); ?>
							<td id="desc-<?php echo $linha->id_video; ?>"  style="border:1px solid;padding:5px;overflow: hidden;text-overflow: ellipsis; white-space: nowrap;" title="<?php echo $descricao; ?>">
								<?php echo $descricao; ?>
							</td>
							<td style="border:1px solid;padding:5px;">
								<?php echo $linha->data_pub." às ".$linha->horario; ?>
							</td>
							<td style="border:1px solid;padding:5px;overflow: hidden;text-overflow: ellipsis; white-space: nowrap;"title="<?php echo number_format($linha->views); ?>">
								<center><?php echo number_format($linha->views); ?></center>
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
							<td style="border:1px solid;" >
							<center>
							<?php if($linha->excluido == 'n'){ echo '<p onclick="confirmaExc('.$linha->id_video.' )"><img src="imagens/delete.png" style="cursor: pointer;" title="Excluir Vídeo" ></p>'; } else{ echo '<p onclick="confirmaExc('.$linha->id_video.')"><img src="imagens/sim.png" style="cursor: pointer;" title="Ativar Vídeo" ></p>'; } ?>
							
							<script>
							function confirmaExc(posicao){
								
									swal({
								  title: "Você tem certeza?",
								  text: "Desativar/Ativar",
								  type: "warning",
								  showCancelButton: true,
								  confirmButtonColor: '#00aa66',
								  cancelButtonColor: '#dd3300',
								  confirmButtonText: 'Sim',
								  cancelButtonText: 'Não',
								  confirmButtonClass: 'btn btn-success',
								  cancelButtonClass: 'btn btn-cancel',
								  buttonsStyling: false
								},
								function(){
									window.location.assign("adm-exclui?id_video="+posicao+"");
								  //swal("Deleted!", "Your imaginary file has been deleted.", "success");
								  
								});
									
									
							}
							</script>
							</center>
							</td>
						</tr>
						<?php }
						
				
						
						
						?>
			</table>
			
			<?php
				$sql_Total = 'SELECT id_video FROM videos';
					
				

					$query_Total = $db->prepare($sql_Total);
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
					$pg_ant=$pg-1;
					echo "<center> ";
					if($pg_ant>=1)
					{
					echo "<a class='anterior' href='adm-videos.php?pg=$pg_ant'>Anterior</a> ";
					}
					if($qtdPag>1)
					{
					if($qtdPag > 1 && $pg <= $qtdPag){

						for($i = 1; $i <= $qtdPag; $i++){

								if($i == $pg){

										echo " <a class='ativo'>".$i."</a> ";

								} else {

										echo " <a href='adm-videos.php?pg=$i'>".$i."</a> ";

								}

						}

													}				
				$pgProx=$pg+1;
				if($pgProx<=$qtdPag)
				{
				echo "<a class='proxima' href='adm-videos.php?pg=$pgProx'>Próxima</a> </center>";
				}
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

	</div> 
	<?php include "rodape.php"; ?>
</html>
</body>