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
	
	<?php
	function page_title($url) {
		$fp = file_get_contents($url);
		if (!$fp) 
			return null;

		$res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
		if (!$res) 
			return null; 

		// Clean up title: remove EOL's and excessive whitespace.
		$title = preg_replace('/\s+/', ' ', $title_matches[1]);
		$title = trim($title);
		return $title;
	}
	?>
		
		<!--Menu do Centro - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
	
		<?php 
		include "conecta.php";
		
		$consulta_priv = $db->prepare('SELECT * FROM paginas');
		$consulta_priv->execute();
		
		$num_linhas_priv = $consulta_priv->rowCount();
		
		if($num_linhas_priv < 1)
		{ ?>
			Algo deu errado.
		<?php }
		
		else{
			$linha_priv = $consulta_priv->fetch(PDO::FETCH_ASSOC);
			
			if($linha_priv['videos']=='s' && ($_SESSION['tipo']==0 || $_SESSION['tipo']==NULL)){ ?>
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
				if($linha_priv['videos']=='s' && $_SESSION['tipo']==1){ ?>
					<div style="background-color:black;color:white;padding:10px;width:950px;border-radius:8px;">
					Está página se encontra privada para usuários comuns.
					</div><br>
				<?php } ?>
		
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
			<h2>Vídeos<?php if($_SESSION['tipo']==1){ ?><a href="adm-pgs.php"><img src="imagens/config.png" style="float:right;" title="Configurar Páginas"></a><?php } ?></h2><hr class="est1">
			
			<?php
			$o = $_GET["o"];
			
			if($o == "")
			{
				include "conecta.php";
				
				//Destaque
				$consulta_d = $db->prepare("SELECT * FROM videos WHERE destaque = 1 AND excluido = 'n'");
				$consulta_d->execute();
				
				$num_linhas_d = $consulta_d->rowCount();
				
				if($num_linhas_d > 0)
				{
					$linha_d = $consulta_d->fetch(PDO::FETCH_ASSOC);
					$yt_link = "https://www.youtube.com/embed/".$linha_d['ytlink']."?rel=0";
					$yt_link2 = "https://www.youtube.com/watch?v=".$linha_d['ytlink'];
					
				?>
				<div id="videos-destaque" style="float:left;border:1px solid black;border-radius:8px;padding:10px;border: 1px solid #D8D8D8;width:100%;margin-bottom:15px;overflow:hidden;">
					<!--5 vídeos na linha-->
					
					<div id="icon-img" style="background-image: url('imagens/favs.png');height:30px;margin-right:7px;"></div>
					<font size="5px" style="margin-bottom:5px;">Vídeo em Destaque</font><?php if($_SESSION['tipo']==1){ ?><a href="#" OnClick="deldestaque()" style="text-align:right;float:right;">Remover</a><?php } ?><br>
					
					<!-- INICIO - PLAYER DE VÍDEO -->			
					<iframe style="margin-top:10px;margin:15px;" width="640" height="360" src="<?php echo $yt_link; ?>" frameborder="0" allowfullscreen></iframe>
					<!-- FIM - PLAYER DE VÍDEO -->
					
					<div id="videos-favdir" style="border:1px solid black;height:370px;width:250px;float:right;border-radius:8px;padding:10px;border:1px solid #D8D8D8;overflow:hidden;">
						<font style="font-weight:bold;font-size:15px;"><a href="assistir.php?v=<?php echo $linha_d['id_video']; ?>"><?php echo $linha_d['nome']; ?></a></font><br>
						<font style="font-size:12px;"><?php echo $linha_d['data_pub']." às ".$linha_d['horario']; ?></font><br>
						<?php echo $linha_d['descr']; ?>
					</div><br>
					
					<font style="margin:15px;font-size:20px;"><?php echo number_format($linha_d['views'])." visualizações."; ?></font>
					
				</div><?php 
				} ?>
				
				
				<div id="videos-recentes" style="float:left;border:1px solid black;border-radius:8px;padding:10px;border: 1px solid #D8D8D8;width:100%;overflow:hidden;">
					<div id="icon-img" style="background-image: url('imagens/tempo.png');height:30px;margin-right:7px;"></div>
					<font size="5px" style="margin-bottom:5px;">Recentes</font><br>
					<!--5 vídeos na linha-->
					
					<?php					
					//Recentes
					$consulta_r = $db->prepare("SELECT * FROM videos WHERE excluido = 'n' order by id_video desc limit 5");
					$consulta_r->execute();
					
					$num_linhas_r = $consulta_r->rowCount();
					
					while($linha_r = $consulta_r->fetch(PDO::FETCH_OBJ))
					{ 
					?>
					<div id="video-thumb" style="min-height:142px;max-height:200px;min-width:150px;max-width:150px;float:left;background-color:transparent;margin:10px;">
						<div style="height:98px;background-color:transparent;position: relative;">
							<a href="assistir.php?v=<?php echo $linha_r->id_video; ?>">
								<img class="video-thumbimg" height="97px" width="150px" style="background-image: url('<?php echo $linha_r->img_cover; ?>');
								background-repeat: no-repeat;background-position: center;background-size: 167px 97px;
								height:97px;width:150px;border:1px solid #BDBDBD;
								margin-bottom:4px;padding:0px;position:relative;">
							</a>
							<?php if($_SESSION['tipo']==1){ ?><a href="destaque-geral.php?acao=add&id_video=<?php echo $linha_r->id_video; ?>" title="Destacar"><img src="imagens/des-1.png" height="25px" style="position:absolute;z-index:+1;bottom:3;right:3"></a><?php } ?>
						</div>
						<a href="assistir.php?v=<?php echo $linha_r->id_video; ?>" title="<?php echo strtoupper($linha_r->nome); ?>"><div style="overflow:hidden;min-height:20px;max-height:40px;background-color:transparent;"><font style="color:#4274D7;font-weight:bold;"><?php if(strlen($linha_r->nome) > 35){ echo (substr($linha_r->nome, 0, 34))."..." ; } else{ echo ($linha_r->nome); } ?></font></div></a>
						<font style="font-size:11px;">
							Postado 
							<?php 
							if($linha_r->data_pub == date("d/m/Y"))
							{
								$min = ((strtotime($linha_r->horario) - strtotime(date("H:i:m"))) / 60)*(-1);
								
								if($min < 60){ echo $min." minutos atrás."; }
								if($min >= 60 && $min < 120){ echo "1 hora atrás."; }
								if($min >= 120 && $min < 1440){
									$min = round($min/60,0);
									echo $min." horas atrás.";
								}
							}
							else {
								echo "em ".$linha_r->data_pub.".";
							} 
							?>
						</font><br>
						<span title="<?php echo number_format($linha_r->views); ?> visitas"><img src="imagens/play.png"><font style="font-size:11px;"><?php echo number_format($linha_r->views); ?> visitas.</font></span>
					</div>
					<?php
					} ?>
					<a href="videos.php?o=rec"><div style="overflow:hidden;height:95px;width:70px;border: 1px solid #D8D8D8;border-radius: 8px;
					float:left;margin-top:10px;padding:10px;text-align:center;cursor:pointer;">
						<font size="5px">Ver</font> mais<br><font size="4px">. . .</font>
					</div></a>
				</div>
				
				
				<div id="videos-recentes" style="float:left;border:1px solid black;border-radius:8px;padding:10px;border: 1px solid #D8D8D8;width:100%;margin-top:15px;overflow:hidden;">
					<div id="icon-img" style="background-image: url('imagens/fire.png');height:30px;margin-right:7px;"></div>
					<font size="5px" style="margin-bottom:5px;">Populares</font><br>
					<!--5 vídeos na linha-->
					
					<?php					
					//Populares
					$consulta_p = $db->prepare("SELECT * FROM videos WHERE excluido = 'n' ORDER BY views DESC limit 5");
					$consulta_p->execute();
					
					$num_linhas_p = $consulta_p->rowCount();
					
					while($linha_p = $consulta_p->fetch(PDO::FETCH_OBJ))
					{ 
					?>				
					<div id="video-thumb" style="min-height:162px;max-height:220px;min-width:150px;max-width:150px;float:left;background-color:transparent;margin:10px;">
						<div style="height:98px;background-color:transparent;position: relative;">
							<a href="assistir.php?v=<?php echo $linha_p->id_video; ?>">
								<img class="video-thumbimg" height="97px" width="150px" style="background-image: url('<?php echo $linha_p->img_cover; ?>');
								background-repeat: no-repeat;background-position: center;background-size: 167px 97px;
								height:97px;width:150px;border:1px solid #BDBDBD;
								margin-bottom:4px;padding:0px;position:relative;">
							</a>
							<?php if($_SESSION['tipo']==1){ ?><a href="destaque-geral.php?acao=add&id_video=<?php echo $linha_p->id_video; ?>" title="Destacar"><img src="imagens/des-1.png" height="25px" style="position:absolute;z-index:+1;bottom:3;right:3"></a><?php } ?>
						</div>
						<a href="assistir.php?v=<?php echo $linha_p->id_video; ?>" title="<?php echo strtoupper($linha_p->nome); ?>"><div style="overflow:hidden;min-height:20px;max-height:40px;background-color:transparent;"><font style="color:#4274D7;font-weight:bold;"><?php if(strlen($linha_p->nome) > 35){ echo (substr($linha_p->nome, 0, 34))."..." ; } else{ echo ($linha_p->nome); } ?></font></div></a>
						<font style="font-size:11px;">Postado <?php if($linha_p->data_pub == date("d/m/Y")) { echo "hoje."; } else { echo "em ".$linha_p->data_pub."."; } ?></font><br>
						<span title="<?php echo number_format($linha_p->views); ?> visitas"><img src="imagens/play.png"><font style="font-size:11px;"><?php echo number_format($linha_p->views); ?> visitas.</font></span>
					</div>
					<?php
					} ?>
					<a href="videos.php?o=pop"><div style="overflow:hidden;height:95px;width:70px;border: 1px solid #D8D8D8;border-radius: 8px;
					float:left;margin-top:10px;padding:10px;text-align:center;cursor:pointer;">
						<font size="5px">Ver</font> mais<br><font size="4px">. . .</font>
					</div></a>
				</div>
			<?php 
			} 
			else if($o == "rec")
			{ ?>
				<div id="videos-destaque" style="float:left;border:1px solid black;border-radius:8px;padding:10px;border: 1px solid #D8D8D8;width:100%;overflow:hidden;padding-bottom:25px;">
					<div id="icon-img" style="background-image: url('imagens/tempo.png');height:30px;margin-right:7px"></div>
					<font size="5px" style="margin-bottom:5px;font-weight:bold;">Recentes</font><br>
				<?php
				//Todos os Recentes
				include "conecta.php";
				
				
				 
				// Find out how many items are in the table
				$total = $db->query("SELECT COUNT(*) FROM videos WHERE excluido = 'n'")->fetchColumn();

				// How many items to list per page
				$limit = 10;

				// How many pages will there be
				$pages = ceil($total / $limit);
				
				// What page are we currently on?
				$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
				'options' => array('default' => 1,'min_range' => 1)
				))); 

				// Calculate the offset for the query
				$offset = ($page - 1)  * $limit;

				// Some information to display to the user
				$start = $offset + 1;
				$end = min(($offset + $limit), $total);

				// The "back" link
				$prevlink = ($page > 1) ? '<a href="videos.php?o=pop&page=1" style="font-size:25px" title="Primeira">&laquo;</a> <a href="videos.php?o=pop&page='.($page-1).'" style="font-size:25px" title="Anterior">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

				// The "forward" link
				$nextlink = ($page < $pages) ? '<a href="videos.php?o=pop&page='.($page+1).'" style="font-size:25px" title="Próxima">&rsaquo;</a> <a href="videos.php?o=pop&page='.$pages.'" style="font-size:25px" title="Última">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

				// Display the paging information
				echo '<div id="paging"><p>',$prevlink.' Página '.$page.'/'.$pages.', mostrando '.$start.'-'.$end.' de '.$total.' resultados '.$nextlink.'. </p></div>';

				$consulta_r = $db->prepare("SELECT * FROM videos WHERE excluido = 'n' ORDER BY id_video desc LIMIT :limit OFFSET :offset");
				$consulta_r->bindParam(':limit', $limit, PDO::PARAM_INT);
				$consulta_r->bindParam(':offset', $offset, PDO::PARAM_INT);
				$consulta_r->execute();

				// Do we have any results?
				if ($consulta_r->rowCount() > 0) {
					$num_linhas_r = $consulta_r->rowCount();
					
					while($linha_r = $consulta_r->fetch(PDO::FETCH_OBJ))
					{
						?>
						<div id="video-thumb" style="height:200px;width:150px;float:left;background-color:transparent;margin:17px;margin-bottom:25px;">
							<div style="height:98px;background-color:transparent;position: relative;">
								<a href="assistir.php?v=<?php echo $linha_r->id_video; ?>">
									<img class="video-thumbimg" height="97px" width="150px" style="background-image: url('<?php echo $linha_r->img_cover; ?>');
									background-repeat: no-repeat;background-position: center;background-size: 167px 97px;
									height:97px;width:150px;border:1px solid #BDBDBD;
									margin-bottom:4px;padding:0px;position:relative;">
								</a>
								<?php if($_SESSION['tipo']==1){ ?><a href="destaque-geral.php?acao=add&id_video=<?php echo $linha_r->id_video; ?>" title="Destacar"><img src="imagens/des-1.png" height="25px" style="position:absolute;z-index:+1;bottom:3;right:3"></a><?php } ?>
							</div>
							<a href="assistir.php?v=<?php echo $linha_r->id_video; ?>" title="<?php echo strtoupper($linha_r->nome); ?>"><div style="overflow:hidden;min-height:20px;max-height:40px;background-color:transparent;"><font style="color:#4274D7;font-weight:bold;"><?php if(strlen($linha_r->nome) > 35){ echo (substr($linha_r->nome, 0, 34))."..." ; } else{ echo ($linha_r->nome); } ?></font></div></a>
							<font style="font-size:11px;">
								Postado 
								<?php 
								if($linha_r->data_pub == date("d/m/Y"))
								{
									$min = ((strtotime($linha_r->horario) - strtotime(date("H:i:m"))) / 60)*(-1);
									
									if($min < 60){ echo $min." minutos atrás."; }
									if($min >= 60 && $min < 120){ echo "1 hora atrás."; }
									if($min >= 120 && $min < 1440){
										$min = round($min/60,0);
										echo $min." horas atrás.";
									}
								}
								else {
									echo "em ".$linha_r->data_pub.".";
								} 
								?>
							</font><br>
							<span title="<?php echo number_format($linha_r->views); ?> visitas"><img src="imagens/play.png"><font style="font-size:11px;"><?php echo number_format($linha_r->views); ?> visitas.</font></span>
						</div>
						<?php
					}
				}
				else{ echo '<p>Não foram encontrados resultados.</p>'; }
				?>
				
				</div><?php
			}
			else if($o == "pop")
			{ ?>
				<div id="videos-destaque" style="float:left;border:1px solid black;border-radius:8px;padding:10px;border: 1px solid #D8D8D8;width:100%;overflow:hidden;padding-bottom:25px;">
					<div id="icon-img" style="background-image: url('imagens/favs.png');height:30px;margin-right:7px"></div>
					<font size="5px" style="margin-bottom:5px;font-weight:bold;">Populares</font><br>
				<?php
				//Todos os Recentes
				include "conecta.php";
				
				
				 
				// Find out how many items are in the table
				$total = $db->query("SELECT COUNT(*) FROM videos WHERE excluido = 'n'")->fetchColumn();

				// How many items to list per page
				$limit = 10;

				// How many pages will there be
				$pages = ceil($total / $limit);
				
				// What page are we currently on?
				$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
				'options' => array('default' => 1,'min_range' => 1)
				))); 

				// Calculate the offset for the query
				$offset = ($page - 1)  * $limit;

				// Some information to display to the user
				$start = $offset + 1;
				$end = min(($offset + $limit), $total);

				// The "back" link
				$prevlink = ($page > 1) ? '<a href="videos.php?o=pop&page=1" style="font-size:25px" title="Primeira">&laquo;</a> <a href="videos.php?o=pop&page='.($page-1).'" style="font-size:25px" title="Anterior">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

				// The "forward" link
				$nextlink = ($page < $pages) ? '<a href="videos.php?o=pop&page='.($page+1).'" style="font-size:25px" title="Próxima">&rsaquo;</a> <a href="videos.php?o=pop&page='.$pages.'" style="font-size:25px" title="Última">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

				// Display the paging information
				echo '<div id="paging"><p>',$prevlink.' Página '.$page.'/'.$pages.', mostrando '.$start.'-'.$end.' de '.$total.' resultados '.$nextlink.'. </p></div>';

				$consulta_p = $db->prepare("SELECT * FROM videos WHERE excluido = 'n' ORDER BY views desc LIMIT :limit OFFSET :offset");
				$consulta_p->bindParam(':limit', $limit, PDO::PARAM_INT);
				$consulta_p->bindParam(':offset', $offset, PDO::PARAM_INT);
				$consulta_p->execute();

				// Do we have any results?
				if ($consulta_p->rowCount() > 0) {
					$num_linhas_p = $consulta_p->rowCount();
					
					while($linha_p = $consulta_p->fetch(PDO::FETCH_OBJ))
					{
						?>
						<div id="video-thumb" style="height:200px;width:150px;float:left;background-color:transparent;margin:17px;margin-bottom:25px;">
							<div style="height:98px;background-color:transparent;position: relative;">
								<a href="assistir.php?v=<?php echo $linha_p->id_video; ?>">
									<img class="video-thumbimg" height="97px" width="150px" style="background-image: url('<?php echo $linha_p->img_cover; ?>');
									background-repeat: no-repeat;background-position: center;background-size: 167px 97px;
									height:97px;width:150px;border:1px solid #BDBDBD;
									margin-bottom:4px;padding:0px;position:relative;">
								</a>
								<?php if($_SESSION['tipo']==1){ ?><a href="destaque-geral.php?acao=add&id_video=<?php echo $linha_p->id_video; ?>" title="Destacar"><img src="imagens/des-1.png" height="25px" style="position:absolute;z-index:+1;bottom:3;right:3"></a><?php } ?>
							</div>
							<a href="assistir.php?v=<?php echo $linha_p->id_video; ?>" title="<?php echo strtoupper($linha_p->nome); ?>"><div style="overflow:hidden;min-height:20px;max-height:40px;background-color:transparent;"><font style="color:#4274D7;font-weight:bold;"><?php if(strlen($linha_p->nome) > 35){ echo (substr($linha_p->nome, 0, 34))."..." ; } else{ echo ($linha_p->nome); } ?></font></div></a>
							<font style="font-size:11px;">Postado <?php if($linha_p->data_pub == date("d/m/Y")) { echo "hoje."; } else { echo "em ".$linha_p->data_pub."."; } ?></font><br>
							<span title="<?php echo number_format($linha_p->views) ?> visitas"><img src="imagens/play.png"><font style="font-size:11px;"><?php echo number_format($linha_p->views) ?> visitas.</font></span>
						</div>
						<?php
					}
				}
				else{ echo '<p>Não foram encontrados resultados.</p>'; }
				?>
				
				</div><?php
			}?>
			
			<?php if($_SESSION['tipo'] == 1)
			{ ?>
			
			<!-- INICIO - VIDEO POPUP -->
			<a href="#primary" data-toggle="modal" class="btn btn-primary btn3d" style="float:right;color:white;display:inline;">Registrar Vídeo</a>
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
			<br><br>
			
			<?php } ?>
			
		</div>
		<!--Menu do Centro - FIM -->
		<?php }
		}?>
	
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