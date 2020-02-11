<?php
	session_start();
	include "conecta.php";
	$v = $_GET['v'];
	
	//Select do vídeo
	$consulta_video = $db->prepare('SELECT * FROM videos WHERE id_video = ?');
	$consulta_video->bindParam(1,$v, PDO::PARAM_INT);
	$consulta_video->execute();
	
	$num_linhas_video = $consulta_video->rowCount();
	$linha_video = $consulta_video->fetch(PDO::FETCH_ASSOC);
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
	<title><?php if($num_linhas_video < 1){ echo "Kepler"; } else{ echo "".$linha_video['nome']." - Kepler"; } ?></title>
</head>

<body style="font-family: 'Raleway', sans-serif;">
	<?php include "cabecalho.php";
		/////////////////////////////////////////////////////////////////////
		
		//Verificar se a página está privada.
		$consulta_priv = $db->prepare('SELECT * FROM paginas');
		$consulta_priv->execute();
		$num_linhas_priv = $consulta_priv->rowCount();
		
		if($num_linhas_video < 1 || $num_linhas_priv < 1){
			include "404.php";
		} 
		else{ 
			$linha_priv = $consulta_priv->fetch(PDO::FETCH_ASSOC);
			
			if($linha_priv['videos']=='s' && ($_SESSION['tipo']==0 || $_SESSION['tipo']==NULL)){ ?>
			<div id="mae" style="width:1010px;max-width:1010px;background-color:transparent;margin: 0 auto;">
				<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
					<h2>
						<i>Ops!</i>
					</h2>
					<hr class="est1">
					<div style="background-color:black;color:white;padding:10px;width:950px;border-radius:8px;">Está página foi configurada como privada por um administrador, talvez ela esteja em manutenção no momento. Tente novamente mais tarde, pode ser que ela já esteja disponível.</div>
					
					<br>
					<center><img src="imagens/manutencao.jpg" height="300px"></center>
				</div>
			</div>
			<?php 
			}
			
			else{
				?><div id="mae" style="width:1010px;max-width:1010px;background-color:transparent;margin: 0 auto;"><?php
				if($linha_priv['videos']=='s' && $_SESSION['tipo']==1){ ?>
					<div style="background-color:black;color:white;padding:10px;width:950px;border-radius:8px;">
					Está página se encontra privada para usuários comuns.
					</div><br>
				<?php } 
				
			$yt_link = "https://www.youtube.com/embed/".$linha_video['ytlink']."?rel=0";
			$yt_link2 = "https://www.youtube.com/watch?v=".$linha_video['ytlink'];
			$link_baixar_video= "https://www.ssyoutube.com/watch?v=".$linha_video['ytlink']; ?>
		
		<div id="cont-centro" style="padding-top:3px;margin-left:0px;">
			<h2>Vídeos</h2>
		
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
					alert("k m8");
					window.location.href = "index.php";
				}
			}
			</script>
			
				<!-- INICIO - PLAYER DE VÍDEO -->			
				<div style="height:395px;width:100%;background-color:black;margin-top:10px;float:left;">
				<center><iframe width="700" height="394" src="<?php echo $yt_link; ?>" frameborder="0" allowfullscreen></iframe></center>
				</div>
				<!-- FIM - PLAYER DE VÍDEO -->
				
				<div id="assistir-desc" style="margin-top:10px;border:1px solid black;min-height:150px;width:960px;float:right;border-radius:8px;padding:10px;border:1px solid #D8D8D8;overflow:hidden;">
					<font style="font-weight:bold;font-size:20px;"><?php echo $linha_video['nome']; ?></font><br>
					<font style="font-size:15px;"><?php echo $linha_video['data_pub']." às ".$linha_video['horario']; ?></font><br>
					<?php echo $linha_video['descr']; ?>	
				</div>
				<font style="margin-top:10px;font-size:20px;float:left;width:900px;"><?php echo number_format($linha_video['views'])." visualizações."; ?></font>
				
				<br><br>
				<div style="float:left;">
					<br><br>
					<h3 style="margin-top:-10px;"><b>Downloads</b></h3>
					<?php
					
					// Download Videos from Youtube in PHP
					// By: Sheharyar Naseer

					$id = $linha_video['ytlink']; // just in case

					if (isset($_GET["id"])) { $id = $_GET["id"]; }

					parse_str(file_get_contents('http://www.youtube.com/get_video_info?video_id='.$id), $video_data);

					$streams = $video_data['url_encoded_fmt_stream_map'];
					$streams = explode(',',$streams);
					$counter = 1;

					foreach ($streams as $streamdata) {
						echo '<div style="border:1px solid #bdbdbd;border-radius:8px;width:200px;height:150px;margin-right:10px;padding:8px;overflow:hidden;float:left;">';
						printf("<center><b style='color:#4e8ddb'>Download %d:</b></center>", $counter);
						
						parse_str($streamdata,$streamdata);
						
						if($streamdata == NULL)
						{ echo "Não há downloads disponíveis para este vídeo."; }
						else{
							foreach ($streamdata as $key => $value) {
								if ($key == "quality"){
									$value = urldecode($value);
									if($value == "small")
									{ printf("<b>Qualidade:</b> Baixa<br>"); }
									else if($value == "medium")
									{ printf("<b>Qualidade:</b> Média<br>"); }
									else if($value == "high")
									{ printf("<b>Qualidade:</b> Alta<br>"); }
								}
								else if ($key == "type"){
									$value = urldecode($value);
									printf("<b>Tipo:</b> %s<br>", $value);
								}
								else{
									if ($key == "url"){
										$value = urldecode($value);
										printf("<a href='%s' target='_blank' style='margin-top:0px;'>Baixar</a><br>", $value);
									}
								}
							}
						}

						$counter = $counter+1;
						echo '</div>';
					}

					// start server and go to http://url/?id=video-id
					
					?>
				</div>
			
		</div>
		<!--Menu do Centro - FIM -->
		<?php 
			}
		}		?>
	
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