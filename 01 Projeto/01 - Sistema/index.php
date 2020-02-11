<?php
	session_start();
?>
<html lang="pt-br">
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
	<title>Kepler</title>
	
	
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php"; 
		include "conecta.php";
		?>
		
		<!--Menu da Esquerda - INICIO -->
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
		<div id="cont-esquerda" style="margin-left:0px;">
			<?php
					$hora_original = date('H');
					$hora_certa = $hora_original;
					$diaa=date("Y-m-d");
					$sqll="SELECT nome FROM agendamento,astros WHERE data_agen='".$diaa."' and agendamento.id_astro=astros.id_astro and hora_agen=".$hora_certa;
					$consultaa = $db->prepare($sqll);
					$consultaa->execute(); 
					$linhaa = $consultaa->fetch(PDO::FETCH_OBJ);
					$agora="Horário livre";
					if(!empty($linhaa->nome))
					{
						$agora=$linhaa->nome;
					}
			?>
			<div id="item-esquerda-comp" style="padding-bottom:12px;">
				<img src="imagens/camera.png" style="height:20px;margin-right:4px;"><b>Transmitindo:</b><br><font size="5px" style="margin-left:25px;color:red"><?php echo "".$agora;?></font>
				<form action="livestream.php"><input type="submit" class="btn btn-primary btn3d" style="width:240px;margin-bottom:-11px;" value="Assistir"></form>
			</div>
			
			<div id="item-esquerda">
				<div id="ie-titulo">Próximas Transmissões</div>
				<div id="ie-cont">
				<?php
				
	
					$dia=date("Y-m-d");
					$sql="SELECT nome,hora_agen,data_agen FROM agendamento,astros WHERE data_agen='".$dia."' and agendamento.id_astro=astros.id_astro";
					$consulta = $db->prepare($sql);
					$consulta->execute();  
					
					$hora1="Horário livre";
					$hora2="Horário livre";
					$hora3="Horário livre";
					$hora4="Horário livre";
					$hora5="Horário livre";
					
					while($linha = $consulta->fetch(PDO::FETCH_OBJ))
					{
						if($linha->hora_agen == $hora_certa+1)
						{
							$hora1=$linha->nome;
						}
						if($linha->hora_agen == $hora_certa+2)
						{
							$hora2=$linha->nome;
						}
						if($linha->hora_agen == $hora_certa+3)
						{
							$hora3=$linha->nome;
						}
						if($linha->hora_agen == $hora_certa+4)
						{
							$hora4=$linha->nome;
						}
						if($linha->hora_agen == $hora_certa+5)
						{
							$hora5=$linha->nome;
						}
					}
					
					
				?>
					<font style="color:red;font-size:19px;font-weight:bold;"><?php  if($hora_certa+1<24){ echo $hora_certa+1; }else{ echo $hora_certa+1-24; }?>:00</font><font style="margin-left:5px"> <?php echo $hora1;?></font><br>
					<font style="color:red;font-size:19px;font-weight:bold;"><?php  if($hora_certa+2<24){ echo $hora_certa+2; }else{ echo $hora_certa+2-24; }?>:00</font><font style="margin-left:5px"> <?php echo $hora2;?></font><br>
					<font style="color:red;font-size:19px;font-weight:bold;"><?php	if($hora_certa+3<24){ echo $hora_certa+3; }else{ echo $hora_certa+3-24; }?>:00</font><font style="margin-left:5px"> <?php echo $hora3;?></font><br>
					<font style="color:red;font-size:19px;font-weight:bold;"><?php  if($hora_certa+4<24){ echo $hora_certa+4; }else{ echo $hora_certa+4-24; }?>:00</font><font style="margin-left:5px<"> <?php echo $hora4;?></font><br>
					<font style="color:red;font-size:19px;font-weight:bold;"><?php  if($hora_certa+5<24){ echo $hora_certa+5; }else{ echo $hora_certa+5-24; }?>:00</font><font style="margin-left:5px"><?php echo $hora5;?></font><br>
					
					<!-- INICIO - ANUNCIO POPUP -->
						<a href="#prog" data-toggle="modal" class="btn btn-primary btn3d" style="width:240px;margin-bottom:10px;margin-top:13px;color:white;">Ver Programação Completa</a>
						<!-- Modal -->
						<div class="modal fade" id="prog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body" style="color:black;">
										<h3 style="margin-top:-3px;margin-bottom:20px;">Programação</h3>
										
										<span style="padding:5px;border:1px solid #D8D8D8;border-radius:5px;"><?php echo date("d/m/Y"); ?></span>
										
										<br>
										<div style="border:1px solid #D8D8D8;border-radius:5px;float:left;padding:10px;margin-bottom:10px;margin-top:20px;">
										
											
											<div style="float:left;width:540px;background-color:white;">
													<?php
												$sql="SELECT nome,hora_agen FROM agendamento,astros WHERE data_agen='".$dia."' and agendamento.id_astro=astros.id_astro";
												$consulta = $db->prepare($sql);
												$consulta->execute();
												$result = $consulta-> fetchAll();
												
												for($i=0;$i<=23;$i+=8){
													$flag=1;//echo$i;
													foreach( $result as $row ) 
													{
														
														if($row['hora_agen']==$i){
															
															$flag=2;
															//echo $i;
															?>
															<div style="background-color:white;width:90px;height:60px;line-height:25px;float:left;text-align:center;"><font style="color:red;font-size:19px;font-weight:bold;"><?php echo $i; ?>:00</font></div>
															<div style="background-color:white;width:90px;height:60px;line-height:25px;float:left;text-align:left;"><font style="margin-left:5px"><?php echo "".$row['nome']; ?></font></div>
															<?php
															
														}
													}
													if($flag==1)
													{
																//echo $i;
																//echo $flag;
																$flag=2;
															?>
															<div style="background-color:white;width:90px;height:60px;line-height:25px;float:left;text-align:center;"><font style="color:red;font-size:19px;font-weight:bold;"><?php echo $i; ?>:00</font></div>
															<div style="background-color:white;width:90px;height:60px;line-height:25px;float:left;text-align:left;"><font style="margin-left:5px">Livre</font></div>
															<?php
													}
													if($i>=16 && $i!=23)
													{
														$i-=23;
													}
												
												}
											?>
												
											
											
											
							
											</div>
										</div>
										
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
						<!-- FIM - ANUNCIO POPUP -->
				</div>
			</div>
			
		</div>
		<!--Menu da Esquerda - FIM -->
			
		<!--Menu do Centro - INICIO -->
		<div id="cont-direita">
			<?php
			include "conecta.php";
			
			$consulta_slides = $db->prepare('SELECT * FROM slides_index ORDER BY id_slide;');
			$consulta_slides->execute();
			
			$num_linhas_slides = $consulta_slides->rowCount();
			?>
			
			<div class="slideshow-container">
				<?php					
					if($num_linhas_slides > 0){ 
						while($linha_slides = $consulta_slides->fetch(PDO::FETCH_OBJ)){
							?>
							<div class="mySlides fade_slide">
								<div class="numbertext"><?php echo $linha_slides->id_slide; ?> / 3</div>
								<?php if($linha_slides->link_slide != NULL){ ?>
								<a href="<?php echo $linha_slides->link_slide; ?>">
								<?php } ?>
									<div style="background-image: url('<?php echo $linha_slides->imagem_slide; ?>');background-size:100%;background-repeat: no-repeat;
									background-position: center;background-color:black;border: 1px solid black; 
									width:100%;border-radius:8px;height:200px;"></div>
								<?php if($linha_slides->link_slide != NULL){ ?>
								</a>
								<?php } ?>
								<div class="textslide"><?php echo $linha_slides->descr_slide; ?></div>
							</div>
							<?php
						}
					}
					else{ ?>
						<div style="background-position: center;background-color:white;border: 1px solid black; 
						width:100%;border-radius:8px;height:200px;line-height:200px;padding-left:40%;">Erro ao carregar os slides.</div>
					<?php }
				?>
			</div>
				
				<div style="text-align:center;display:none;">
					<span class="dot"></span> 
					<span class="dot"></span> 
					<span class="dot"></span> 
				</div>

				<script>
				var slideIndex = 0;
				showSlides();

				function showSlides() {
					var i;
					var slides = document.getElementsByClassName("mySlides");
					var dots = document.getElementsByClassName("dot");
					for (i = 0; i < slides.length; i++) {
					   slides[i].style.display = "none";  
					}
					slideIndex++;
					if (slideIndex> slides.length) {slideIndex = 1}    
					for (i = 0; i < dots.length; i++) {
						dots[i].className = dots[i].className.replace(" activeslide", "");
					}
					slides[slideIndex-1].style.display = "block";  
					dots[slideIndex-1].className += " activeslide";
					setTimeout(showSlides, 5000); /*Tempo para mudar de slide*/
				}
				</script>
		  
			<br><br>
			
			
			<!--INÍCIO -  ANÚNCIOS -->
			<div class="col-md-6 col-md-offset-3" style="width:730px; float:left;margin-left:-15px;">
				<div class="panel panel-primary">
					<div class="panel-heading">
					<?php
					include "conecta.php";
					
					//Conteúdo dos anúncios.
					$consulta_a = $db->prepare('SELECT anuncios.id_anuncio,anuncios.data,anuncios.login,anuncios.titulo,anuncios.descr,usuario.login,usuario.avatar FROM anuncios,usuario WHERE anuncios.login=usuario.login ORDER BY anuncios.id_anuncio LIMIT 4');
					$consulta_a->execute();
					
					$num_linhas_a = $consulta_a->rowCount();
					
					//Abas dos anúncios com o ID de cada.
					$consulta_b = $db->prepare('SELECT * FROM anuncios ORDER BY id_anuncio LIMIT 4');
					$consulta_b->execute();
					
					$num_linhas_b = $consulta_b->rowCount();
					?>
						
					<?php if($_SESSION['tipo'] == 1) { ?>
						
						<script>
						function restante(){
							document.getElementById("areanum").innerHTML = (1000 - document.getElementById("desctxt").value.length);
						}
						
						function anuncio_img(){
							document.getElementById("desctxt").value = (document.getElementById("desctxt").value + "[img]LINK_DA_IMAGEM_AQUI[/img]");
						}
						</script>
						
						<h3 class="panel-title" style="width:210px;display:inline;margin-right:10px;">
							<div id="icon-img" style="background-size:24px;background-image: url('imagens/megafone2.png');margin-top:-5px;" style="margin-right:7px" title="Últimos Anúncios"></div>
							Últimos Anúncios
						</h3>
						
						
						<!-- INICIO - ANUNCIO POPUP -->
						<a href="#primary" data-toggle="modal" class="btn btn-primary btn3d" style="width:140px;margin-bottom:-11px;color:white;display:inline;">Publicar</a>
						<!-- Modal -->
						<div class="modal fade" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-body" style="color:black;">
										<form action="anuncio-enviar.php" method="post">
										<input pattern="[a-zA-Z0-9 ]+" type="text" name="titulo" id="titulo" style="width:565px;" placeholder="Título" maxlength="32" value="<?php echo $_POST['titulo']; ?>"><br><br>
										
										<textarea onkeyup="restante()" rows="10" cols="88" name="desc" id="desctxt" style="width:565px;padding:5px;resize:vertical;margin-bottom:5px;" placeholder="Insira o conteúdo do anúncio..." maxlength="1000" required><?php echo $_POST['desc']; ?></textarea>
										<br><b>Caracteres restantes:</b> <span id="areanum">1000</span>
										
										<br><img src="imagens/icone-imagem.png" height="40px" title="Inserir Imagem" style="cursor:pointer;" onclick="anuncio_img()">
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
										<input type="submit" class="btn btn-default pull-right" style="width:90px" value="Publicar">
										</form>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
						<!-- FIM - ANUNCIO POPUP -->
						
						
						<span class="pull-right" style="display:inline;margin-top:-10px;">
							<!-- Tabs -->
							<ul class="nav panel-tabs" style="display:inline;">
							<?php 
							$contador = 1;
							while($linha_b = $consulta_b->fetch(PDO::FETCH_OBJ))
							{ 
								$contador++;
								if($linha_b->id_anuncio == 1) { ?>
								<li class="active"><a href="#tab1" data-toggle="tab">1</a></li>
								<?php } 
								
								else { ?>
								<li><a href="#tab<?php echo $linha_b->id_anuncio; ?>" data-toggle="tab"><?php echo $linha_b->id_anuncio; ?></a></li>

								<?php }
							} ?>
							<li><a href="anuncios.php" style="font-size: 20px; height: 33px; margin-top: 4px; margin-bottom: -6px;">...</a></li>
							</ul>
						</span>
					<?php } 
					else { ?>
						<h3 class="panel-title" style="width:210px;display:inline;"><img src="imagens/megafone2.png" height="20px" style="margin-right:7px;"> Últimos Anúncios</h3>
						<span class="pull-right" style="display:inline;margin-top:-10px;">
							<!-- Tabs -->
							<ul class="nav panel-tabs" style="display:inline;">
							<?php 
							while($linha_b = $consulta_b->fetch(PDO::FETCH_OBJ))
							{ 
								if($linha_b->id_anuncio == 1) { ?>
								<li class="active"><a href="#tab1" data-toggle="tab">1</a></li>
								<?php } 
								
								else { ?>
								<li><a href="#tab<?php echo $linha_b->id_anuncio; ?>" data-toggle="tab"><?php echo $linha_b->id_anuncio; ?></a></li>
								<?php } ?>
							<?php 
							} ?>
							<li><a href="anuncios.php" style="font-size: 20px; height: 33px; margin-top: 4px; margin-bottom: -6px;">...</a></li>
							</ul>
						</span>
					<?php } ?>
					</div>
					<div class="panel-body">					
						<div class="tab-content">
						
							<?php //Pega anúncios que tem ID 1 até 4, um por um.
							while($linha_a = $consulta_a->fetch(PDO::FETCH_OBJ))
							{ 
								if($linha_a->id_anuncio == 1){ ?> <div class="tab-pane active" id="tab1"> <?php }
								else{?> <div class="tab-pane" id="tab<?php echo $linha_a->id_anuncio; ?>"> <?php } ?>
										<div id="anuncio-por" style="margin-top:-10px">Publicado por:
										<a href="perfil.php?userp=<?php echo $linha_a->login; ?>">
											<div style="background-image: url('<?php echo $linha_a->avatar; ?>');background-size:25px;background-repeat: no-repeat;
											background-position: center;background-color:black;height:25px; width:25px; border: 1px solid #bdbdbd; 
											cursor:pointer;border-radius:100px;display:inline-block;"></div><?php echo $linha_a->login; ?>
										</a></div>
										<div id="postado-ha"><img src="imagens/tempo.png" height="20px" style="margin-right:4px; margin-bottom:1px"><?php echo $linha_a->data; ?></div><br><br>
										<h2 title="<?php echo $linha_a->titulo; ?>"><?php echo $linha_a->titulo; ?></h2>
										<?php echo $linha_a->descr; ?>
									</div>
								<?php
							}
							?>
							
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--FIM -  ANÚNCIOS -->
			</div>
			
			
		<!--Menu do Centro - FIM -->
	
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