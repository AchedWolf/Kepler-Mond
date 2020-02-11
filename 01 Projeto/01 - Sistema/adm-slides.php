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
		
		<div id="mae" style="width:1010px;max-width:1010px;background-color:white;margin: 0 auto;">
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
		<?php if($_SESSION['tipo'] == 1){ ?>
			<a href="adm-config.php" title="Voltar ao Menu"><div id="icon-img" style="background-image: url('imagens/voltar.png');height:30px;margin-right:7px;float:left;margin-top:20px;"></div></a>
			<h2>Área do Administrador</h2><hr class="est1">
			
			<script>
			function restante(){
				document.getElementById("areanum").innerHTML = (100 - document.getElementById("descr_slide").value.length);
			}
			
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#img_slides_preview').attr('style', "background-image: url('"+e.target.result+"');background-size:100%;background-repeat: no-repeat;background-position: center;background-color:black;border: 1px solid black;width:763px;border-radius:8px;height:200px;");
					}

					reader.readAsDataURL(input.files[0]);
				}
			}
			</script>
			
			<div style="border:1px solid #bdbdbd;border-radius:8px;width:100%;padding:10px;padding-top:20px;">
			<!-- INICIO - VIDEO POPUP -->
			<a href="#primary" data-toggle="modal" class="btn btn-primary btn3d" style="width:140px;color:white;margin-bottom:10px;margin-top:-2px;">Alterar slide</a>
			<!-- Modal -->
			<div class="modal fade" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog" style="width:805px;">
					<div class="modal-content">
					
						<div class="modal-body" style="color:black;">
							<form action="slides-enviar.php" enctype="multipart/form-data" method="post">
							
							<textarea onkeyup="restante()" rows="2" cols="88" name="descr_slide" id="descr_slide" style="width:565px;padding:5px;resize:vertical;margin-bottom:10px;" placeholder="Insira uma curta descrição para o slide..." maxlength="100" required></textarea>
							<br><b>Caracteres restantes:</b> <span id="areanum">100</span><br><br>
							
							<input type="text" name="link_slide" id="link_slide" style="width:565px;" placeholder="URL para o qual o slide levará ao ser clicado..."><br><br>
							
							<input type="number" id="id_slide" name="id_slide" min="1" max="3" style="width:565px;text-align:center;" placeholder="ID do slide que deve ser substituído."><br><br>
							
							<input type="file" accept="image/jpeg, image/png" id="img_slide" name="img_slide" onchange="readURL(this);"><br>
							<font size="2px" style="margin-top:5px;">A imagem deve possuir no máximo 3 MB.</font><br><br>
							
							<input type="hidden" name="MAX_FILE_SIZE" value="3000000"> <!-- Tamanho máximo de 3MB -->
							Preview:<br>
							<div style="background-image: url('');background-size:100%;background-repeat: no-repeat;
							background-position: center;background-color:black;border: 1px solid black; 
							width:763px;border-radius:8px;height:200px;" id="img_slides_preview" name="img_slides_preview"></div>
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
			</div>
			<br>
			
			<?php
			include "conecta.php";
			
			$consulta_slides = $db->prepare('SELECT * FROM slides_index ORDER BY id_slide;');
			$consulta_slides->execute();
			
			$num_linhas_slides = $consulta_slides->rowCount();
			?>
			
			<div class="slideshow-container" style="width:80%;">
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
				<br>
				
				<div style="text-align:center">
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
					setTimeout(showSlides, 3000); /*Tempo para mudar de slide*/
				}
				</script>
		  
			<br><hr class="est1"><br>
			<h4><b>Gerenciar</b></h4>
			
			<a href="adm-imgs.php">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				Slide 1
				</div>
			</a>
			
			<a href="adm-imgs.php">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				Slide 2
				</div>
			</a>
			
			<a href="adm-imgs.php">
				<div style="min-height:32px;line-height:32px;float:left;margin-right:35px;">
				Slide 3
				</div>
			</a>
			
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